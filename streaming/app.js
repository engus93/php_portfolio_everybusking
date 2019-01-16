var express = require('express');
var app = new express();
var http = require('http').createServer(app);
var io = require("socket.io")(http);
var ejs = require('ejs');
var bodyParser = require('body-parser');
var now_user_id = "";
var now_user_name = "";

var port = process.env.PORT || 3000;

app.use(express.static(__dirname + "/public"));

app.get('/chat', function (req, res) {
    res.redirect('/chatting.html')
});

io.on('connection', function (socket) {
    socket.on('stream', function (image) {
        socket.broadcast.emit('stream', image);
    });
});

//----------------------------------------------------------------------------------------------------------------------

app.use(bodyParser.urlencoded({
    extended: true
}));

app.engine('html', ejs.renderFile);

app.post('/stream', function (req, res) {
    console.log('in /chat POST');

    now_user_id = req.body.user_id;
    now_user_name = req.body.user_name;

    console.log('new user : ' + now_user_id);

    res.render(__dirname + '/chatting.html');

});

app.post('/streamer', function (req, res) {
    console.log('in /chat POST');

    now_user_id = req.body.user_id;
    now_user_name = req.body.user_name;

    console.log('new user : ' + now_user_id);

    res.render(__dirname + '/public/emitir.html');

});

var whoIsTyping = [];
var whoIsOn = [];

io.on('connection', function (socket) {

    check = false;

    var nickName = now_user_id;
    var user_name = now_user_name;
    whoIsOn.push(nickName);
    socket.emit('selfData', {nickName: nickName, user_name: user_name});

    io.emit('login', whoIsOn);

    if (whoIsTyping.length != 0) {
        io.emit('typing', whoIsTyping);
    }

    socket.on('setNickName', function (_nickName) {
        var pastNickName = nickName;	//past nickname
        nickName = _nickName;
        if (whoIsTyping.indexOf(pastNickName) != -1) {
            //if he was typing
            console.log('setNickName debug1');
            whoIsTyping.splice(whoIsTyping.indexOf(pastNickName), 1, nickName);
            io.emit('typing', whoIsTyping);
        }

        if (whoIsOn.indexOf(pastNickName) != -1) {
            console.log('setNickName debug2');
            whoIsOn.splice(whoIsOn.indexOf(pastNickName), 1, nickName);
        }
        io.emit('setNickName', {past: pastNickName, current: nickName, whoIsOn: whoIsOn});
        console.log(socket.id + '  to  ' + nickName);
    });

    socket.on('say', function (msg) {
        console.log('message: ' + msg);
        //chat message to the others
        //mySaying to the speaker
        socket.broadcast.emit('chat message', nickName + '  :  ' + msg);
        socket.emit('mySaying', '나  :  ' + msg);
    });


    socket.on('typing', function () {
        if (!whoIsTyping.includes(nickName)) {
            whoIsTyping.push(nickName);
            console.log('who is typing now');
            console.log(whoIsTyping);
            io.emit('typing', whoIsTyping);
        }
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

        console.log(nickName + ' : DISCONNECTED');

        whoIsOn.splice(whoIsOn.indexOf(nickName), 1);

        io.emit('logout', {nickNameArr: whoIsOn, disconnected: nickName});

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

http.listen(3000, function () {
    console.log('listening on *:3000');
});