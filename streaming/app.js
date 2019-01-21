//연결 해주기
var express = require('express');
var app = new express();
var http = require('http').createServer(app);
var io = require("socket.io")(http);
var ejs = require('ejs');
var bodyParser = require('body-parser');

//mysql 접속
var mysql = require('mysql');

var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Reg016260!!',
    database: 'everybusking_db'
});

//현재 접속 정보
var now_user_id = "";
var now_user_name = "";
var now_room_idx = null;
var master_nick = "";

var port = process.env.PORT || 3000;

app.use(express.static(__dirname + "/public"));

app.use(bodyParser.urlencoded({
    extended: true
}));

app.engine('html', ejs.renderFile);

//----------------------------------------------------------------------------------------------------------------------

//방송 찍는 방
app.post('/streamer', function (req, res) {
    now_user_id = req.body.user_id;
    now_user_name = req.body.user_name;
    now_room_idx = req.body.room_idx;
    master_nick = now_user_id;

    res.render(__dirname + '/public/emitir.html');

});

//방송 보는 방
app.post('/stream', function (req, res) {
    now_user_id = req.body.user_id;
    now_user_name = req.body.user_name;
    now_room_idx = req.body.room_idx;

    res.render(__dirname + '/public/chatting.html');

});

//채팅을 치는 사람 배열
var whoIsTyping = [];
//현재 접속 인원
var whoIsOn = [];
var tmp_nick = [];
var room_in_user = [[]];

//커넥션
io.on('connection', function (socket) {

    var nickName = now_user_id;
    var user_name = now_user_name;
    var idx = now_room_idx;

    console.log(now_room_idx);

    console.log(room_in_user[idx]);

    tmp_nick = [];

    for (var key in room_in_user[now_room_idx]) {
        tmp_nick.push(room_in_user[now_room_idx][key]);
    }

    tmp_nick.push(nickName);

    room_in_user[now_room_idx] = tmp_nick;

    whoIsOn = room_in_user[now_room_idx];

    console.log(room_in_user[now_room_idx]);

    // //mysql 접속
    // connection.connect();

    //mysql 구문
    connection.query(`SELECT * from streaming_tb where idx = '${now_room_idx}'`, function (error, results, fields) {
        if (error) throw error;

        console.log("입장 전" + results[0].watch_people);

        var people = results[0].watch_people;

        //mysql 구문
        connection.query(`UPDATE streaming_tb SET watch_people = ${people + 1} where idx = '${now_room_idx}'`, function (error, results, fields) {

            if (error) throw error;

            console.log(people + 1);

        });

    });

    //mysql 종료
    // connection.end();

    //방 구분하기
    socket.join("room" + now_room_idx);

    //각자 보내주기
    socket.emit('selfData', {nickName: nickName, user_name: user_name, room_idx: now_room_idx});

    //로그인 보내기
    io.to("room" + now_room_idx).emit('login', room_in_user[now_room_idx]);

    if (whoIsTyping.length != 0) {
        io.emit('typing', whoIsTyping);
    }

    if (whoIsTyping.length != 0) {
        io.to("room" + now_room_idx).emit('typing', whoIsTyping);
    }

    socket.on('setNickName', function (_nickName) {
        var pastNickName = nickName;	//past nickname
        nickName = _nickName;
        if (whoIsTyping.indexOf(pastNickName) != -1) {
            //if he was typing
            console.log('setNickName debug1');
            whoIsTyping.splice(whoIsTyping.indexOf(pastNickName), 1, nickName);
            io.to("room" + now_room_idx).emit('typing', whoIsTyping);
        }

        if (whoIsOn.indexOf(pastNickName) != -1) {
            console.log('setNickName debug2');
            whoIsOn.splice(whoIsOn.indexOf(pastNickName), 1, nickName);
        }
        io.to("room" + now_room_idx).emit('setNickName', {past: pastNickName, current: nickName, whoIsOn: whoIsOn});
        console.log(socket.id + '  to  ' + nickName);
    });

    socket.on('say', function (msg) {
        console.log('message: ' + msg);
        //chat message to the others
        //mySaying to the speaker
        socket.broadcast.to("room" + idx).emit('chat message', nickName + '  :  ' + msg);
        socket.emit('mySaying', '나  :  ' + msg);
        console.log(now_room_idx);
    });


    socket.on('typing', function () {
        if (!whoIsTyping.includes(nickName)) {
            whoIsTyping.push(nickName);
            console.log('who is typing now');
            console.log(whoIsTyping);
            io.to("room" + now_room_idx).emit('typing', whoIsTyping);
        }
    });

    socket.on('room_boom', function () {
        socket.broadcast.to("room" + idx).emit('room_boom', "강퇴");
    });

    socket.on('quitTyping', function () {
        if (whoIsTyping.length == 0) {
            //if it's empty
            console.log('emit endTyping');
            io.emit('endTyping');
        } else {
            //if someone else is typing
            var index = whoIsTyping.indexOf(nickName);
            console.log(index);
            if (index != -1) {
                whoIsTyping.splice(index, 1);
                if (whoIsTyping.length == 0) {

                    console.log('emit endTyping');
                    io.emit('endTyping');

                } else {
                    io.emit('typing', whoIsTyping);
                    console.log('emit quitTyping');
                    console.log('whoIsTyping after quit');
                    console.log(whoIsTyping);
                }

            }

        }
    });

    //disconnect is in socket
    socket.on('disconnect', function () {

        tmp_nick = [];

        console.log(nickName + ' : DISCONNECTED');

        console.log(now_room_idx);

        console.log(room_in_user[now_room_idx] + " 변경 전");


        for (var key in room_in_user[now_room_idx]) {
            if (room_in_user[now_room_idx][key] != nickName) {
                tmp_nick.push(room_in_user[now_room_idx][key]);
            }
        }

        room_in_user[now_room_idx] = tmp_nick;

        console.log(room_in_user[now_room_idx] + " 변경 후");

        //mysql 구문
        connection.query(`SELECT * from streaming_tb where idx = '${now_room_idx}'`, function (error, results, fields) {
            if (error) throw error;

            console.log("나감 전" + results[0].watch_people);

            var people = results[0].watch_people;

            //mysql 구문
            connection.query(`UPDATE streaming_tb SET watch_people = ${people - 1} where idx = '${now_room_idx}'`, function (error, results, fields) {

                if (error) throw error;

                console.log(people - 1);

            });

        });

        //방장이 방을 나갈시에
        if (master_nick == nickName) {
            socket.broadcast.to("room" + idx).emit('room_boom_re', "강퇴");
        }

        io.to("room" + now_room_idx).emit('logout', {nickNameArr: room_in_user[now_room_idx], disconnected: nickName});

        if (whoIsTyping.length == 0) {
            //if it's empty
            io.emit('endTyping');
        } else {
            //if someone was typing
            var index = whoIsTyping.indexOf(nickName);
            if (index != -1) {
                whoIsTyping.splice(index, 1);

                //if no one is typing now
                if (whoIsTyping.length == 0) {
                    io.emit('endTyping');
                }

                //if someone else is still typing
                else {
                    io.emit('typing', whoIsTyping);
                    console.log('emit popTyping');
                    console.log(whoIsTyping);
                }

            }

        }
    });

});

//포트 접속 리스닝
http.listen(port, function () {
    console.log('listening on *:' + port);
});