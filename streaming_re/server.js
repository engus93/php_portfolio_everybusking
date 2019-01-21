// http://127.0.0.1:9001
// http://localhost:9001

const fs = require('fs');
const path = require('path');
const url = require('url');
var httpServer = require('http');

const ioServer = require('socket.io');
const RTCMultiConnectionServer = require('rtcmulticonnection-server');

var PORT = 3001;
var isUseHTTPs = false;

const jsonPath = {
    config: 'config.json',
    logs: 'logs.json'
};

const BASH_COLORS_HELPER = RTCMultiConnectionServer.BASH_COLORS_HELPER;
const getValuesFromConfigJson = RTCMultiConnectionServer.getValuesFromConfigJson;
const getBashParameters = RTCMultiConnectionServer.getBashParameters;
const resolveURL = RTCMultiConnectionServer.resolveURL;

var config = getValuesFromConfigJson(jsonPath);
config = getBashParameters(config, BASH_COLORS_HELPER);

// if user didn't modifed "PORT" object
// then read value from "config.json"
if(PORT === 3001) {
    PORT = config.port;
}
if(isUseHTTPs === false) {
    isUseHTTPs = config.isUseHTTPs;
}

function serverHandler(request, response) {
    // to make sure we always get valid info from json file
    // even if external codes are overriding it
    config = getValuesFromConfigJson(jsonPath);
    config = getBashParameters(config, BASH_COLORS_HELPER);

    // HTTP_GET handling code goes below
    try {
        var uri, filename;

        try {
            if (!config.dirPath || !config.dirPath.length) {
                config.dirPath = null;
            }

            uri = url.parse(request.url).pathname;
            filename = path.join(config.dirPath ? resolveURL(config.dirPath) : process.cwd(), uri);
        } catch (e) {
            pushLogs(config, 'url.parse', e);
        }

        filename = (filename || '').toString();

        if (request.method !== 'GET' || uri.indexOf('..') !== -1) {
            try {
                response.writeHead(401, {
                    'Content-Type': 'text/plain'
                });
                response.write('401 Unauthorized: ' + path.join('/', uri) + '\n');
                response.end();
                return;
            } catch (e) {
                pushLogs(config, '!GET or ..', e);
            }
        }

        if(filename.indexOf(resolveURL('/admin/')) !== -1 && config.enableAdmin !== true) {
            try {
                response.writeHead(401, {
                    'Content-Type': 'text/plain'
                });
                response.write('401 Unauthorized: ' + path.join('/', uri) + '\n');
                response.end();
                return;
            } catch (e) {
                pushLogs(config, '!GET or ..', e);
            }
            return;
        }

        var matched = false;
        ['/demos/', '/dev/', '/dist/', '/socket.io/', '/node_modules/canvas-designer/', '/admin/'].forEach(function(item) {
            if (filename.indexOf(resolveURL(item)) !== -1) {
                matched = true;
            }
        });

        // files from node_modules
        ['RecordRTC.js', 'FileBufferReader.js', 'getStats.js', 'getScreenId.js', 'adapter.js', 'MultiStreamsMixer.js'].forEach(function(item) {
            if (filename.indexOf(resolveURL('/node_modules/')) !== -1 && filename.indexOf(resolveURL(item)) !== -1) {
                matched = true;
            }
        });

        if (filename.search(/.js|.json/g) !== -1 && !matched) {
            try {
                response.writeHead(404, {
                    'Content-Type': 'text/plain'
                });
                response.write('404 Not Found: ' + path.join('/', uri) + '\n');
                response.end();
                return;
            } catch (e) {
                pushLogs(config, '404 Not Found', e);
            }
        }

        ['Video-Broadcasting', 'Screen-Sharing', 'Switch-Cameras'].forEach(function(fname) {
            try {
                if (filename.indexOf(fname + '.html') !== -1) {
                    filename = filename.replace(fname + '.html', fname.toLowerCase() + '.html');
                }
            } catch (e) {
                pushLogs(config, 'forEach', e);
            }
        });

        var stats;

        try {
            stats = fs.lstatSync(filename);

            if (filename.search(/demos/g) === -1 && filename.search(/admin/g) === -1 && stats.isDirectory() && config.homePage === '/demos/index.html') {
                if (response.redirect) {
                    response.redirect('/demos/');
                } else {
                    response.writeHead(301, {
                        'Location': '/demos/'
                    });
                }
                response.end();
                return;
            }
        } catch (e) {
            response.writeHead(404, {
                'Content-Type': 'text/plain'
            });
            response.write('404 Not Found: ' + path.join('/', uri) + '\n');
            response.end();
            return;
        }

        try {
            if (fs.statSync(filename).isDirectory()) {

                if (filename.indexOf(resolveURL('/demos/MultiRTC/')) !== -1) {
                    filename = filename.replace(resolveURL('/demos/MultiRTC/'), '');
                    filename += resolveURL('/demos/MultiRTC/index.html');
                } else if (filename.indexOf(resolveURL('/admin/')) !== -1) {
                    filename = filename.replace(resolveURL('/admin/'), '');
                    filename += resolveURL('/admin/index.html');
                } else if (filename.indexOf(resolveURL('/demos/dashboard/')) !== -1) {
                    filename = filename.replace(resolveURL('/demos/dashboard/'), '');
                    filename += resolveURL('/demos/dashboard/index.html');
                } else if (filename.indexOf(resolveURL('/demos/video-conference/')) !== -1) {
                    filename = filename.replace(resolveURL('/demos/video-conference/'), '');
                    filename += resolveURL('/demos/video-conference/index.html');
                } else if (filename.indexOf(resolveURL('/')) !== -1) {
                    filename = filename.replace(resolveURL('/demos/'), '');
                    filename = filename.replace(resolveURL('/demos'), '');
                    filename += resolveURL('/demos/emitir.html');
                } else if (filename.indexOf(resolveURL('/streamer')) !== -1) {
                    filename = filename.replace(resolveURL('/streamer/'), '');
                    filename = filename.replace(resolveURL('/streamer'), '');
                    filename += resolveURL('/demos/emitir.html');
                }else{
                    filename += resolveURL(config.homePage);
                }
            }
        } catch (e) {
            pushLogs(config, 'statSync.isDirectory', e);
        }

        var contentType = 'text/plain';
        if (filename.toLowerCase().indexOf('.html') !== -1) {
            contentType = 'text/html';
        }
        if (filename.toLowerCase().indexOf('.css') !== -1) {
            contentType = 'text/css';
        }
        if (filename.toLowerCase().indexOf('.png') !== -1) {
            contentType = 'image/png';
        }

        fs.readFile(filename, 'binary', function(err, file) {
            if (err) {
                response.writeHead(500, {
                    'Content-Type': 'text/plain'
                });
                response.write('404 Not Found: ' + path.join('/', uri) + '\n');
                response.end();
                return;
            }

            try {
                file = file.replace('connection.socketURL = \'/\';', 'connection.socketURL = \'' + config.socketURL + '\';');
            } catch (e) {}

            response.writeHead(200, {
                'Content-Type': contentType
            });
            response.write(file, 'binary');
            response.end();
        });
    } catch (e) {
        pushLogs(config, 'Unexpected', e);

        response.writeHead(404, {
            'Content-Type': 'text/plain'
        });

        response.write('404 Not Found: Unexpected error.\n' + e.message + '\n\n' + e.stack);
        response.end();
    }
}

var httpApp;

if (isUseHTTPs) {
    httpServer = require('https');

    // See how to use a valid certificate:
    // https://github.com/muaz-khan/WebRTC-Experiment/issues/62
    var options = {
        key: null,
        cert: null,
        ca: null
    };

    var pfx = false;

    if (!fs.existsSync(config.sslKey)) {
        console.log(BASH_COLORS_HELPER.getRedFG(), 'sslKey:\t ' + config.sslKey + ' does not exist.');
    } else {
        pfx = config.sslKey.indexOf('.pfx') !== -1;
        options.key = fs.readFileSync(config.sslKey);
    }

    if (!fs.existsSync(config.sslCert)) {
        console.log(BASH_COLORS_HELPER.getRedFG(), 'sslCert:\t ' + config.sslCert + ' does not exist.');
    } else {
        options.cert = fs.readFileSync(config.sslCert);
    }

    if (config.sslCabundle) {
        if (!fs.existsSync(config.sslCabundle)) {
            console.log(BASH_COLORS_HELPER.getRedFG(), 'sslCabundle:\t ' + config.sslCabundle + ' does not exist.');
        }

        options.ca = fs.readFileSync(config.sslCabundle);
    }

    if (pfx === true) {
        options = {
            pfx: sslKey
        };
    }
    httpApp = httpServer.createServer(options, serverHandler);

} else {
    httpApp = httpServer.createServer(serverHandler);
}

RTCMultiConnectionServer.beforeHttpListen(httpApp, config);
httpApp = httpApp.listen(process.env.PORT || PORT, process.env.IP || "0.0.0.0", function() {
    RTCMultiConnectionServer.afterHttpListen(httpApp, config);
});

// //연결 해주기
// var express = require('express');
// var app = new express();
// var http = httpServer.createServer(app);
// var io = require("socket.io")(http);
// var ejs = require('ejs');
// var bodyParser = require('body-parser');
//
// //mysql 접속
// var mysql = require('mysql');
//
// var connection = mysql.createConnection({
//     host: 'localhost',
//     user: 'root',
//     password: 'Reg016260!!',
//     database: 'everybusking_db'
// });
//
// //현재 접속 정보
// var now_user_id = "";
// var now_user_name = "";
// var now_room_idx = null;
//
// var port = process.env.PORT || 3000;
//
// app.use(express.static(__dirname + "/public"));
//
// app.use(bodyParser.urlencoded({
//     extended: true
// }));
//
// app.engine('html', ejs.renderFile);
//
// //----------------------------------------------------------------------------------------------------------------------
//
// //방송 찍는 방
// app.post('/streamer', function (req, res) {
//     now_user_id = req.body.user_id;
//     now_user_name = req.body.user_name;
//     now_room_idx = req.body.room_idx;
//
//     res.render(__dirname + '/public/emitir.html');
//
//     console.log("포스트");
// });
//
// //방송 보는 방
// app.post('/stream', function (req, res) {
//     now_user_id = req.body.user_id;
//     now_user_name = req.body.user_name;
//     now_room_idx = req.body.room_idx;
//
//     res.render(__dirname + '/public/chatting.html');
//
//     console.log("포스트");
//
// });
//
// //채팅을 치는 사람 배열
// var whoIsTyping = [];
// //현재 접속 인원
// var whoIsOn = [];
// var tmp_nick = [];
// var room_in_user = [[]];
//
// // --------------------------
// // socket.io codes goes below

ioServer(httpApp).on('connection', function(socket) {
    RTCMultiConnectionServer.addSocket(socket);

    // ----------------------
    // below code is optional

    const params = socket.handshake.query;

    if (!params.socketCustomEvent) {
        params.socketCustomEvent = 'custom-message';
    }

    socket.on(params.socketCustomEvent, function(message) {
        socket.broadcast.emit(params.socketCustomEvent, message);
    });

    // var nickName = now_user_id;
    // var user_name = now_user_name;
    // var idx = now_room_idx;
    //
    // console.log(now_room_idx);
    //
    // console.log(room_in_user[idx]);
    //
    // tmp_nick = [];
    //
    // for (var key in room_in_user[now_room_idx]) {
    //     tmp_nick.push(room_in_user[now_room_idx][key]);
    // }
    //
    // tmp_nick.push(nickName);
    //
    // room_in_user[now_room_idx] = tmp_nick;
    //
    // whoIsOn = room_in_user[now_room_idx];
    //
    // console.log(room_in_user[now_room_idx]);
    //
    // //방 구분하기
    // socket.join("room" + now_room_idx);
    //
    // //각자 보내주기
    // socket.emit('selfData', {nickName: nickName, user_name: user_name});
    //
    // //로그인 보내기
    // // io.emit('login', room_in_user[now_room_idx]);
    // io.emit('login', room_in_user[now_room_idx]);
    //
    // if (whoIsTyping.length != 0) {
    //     io.emit('typing', whoIsTyping);
    // }
    //
    // if (whoIsTyping.length != 0) {
    //     io.to("room" + now_room_idx).emit('typing', whoIsTyping);
    // }
    //
    // socket.on('say', function (msg) {
    //     console.log('message: ' + msg);
    //     //chat message to the others
    //     //mySaying to the speaker
    //     socket.broadcast.emit('chat message', nickName + '  :  ' + msg);
    //     socket.emit('mySaying', '나  :  ' + msg);
    //     console.log(now_room_idx);
    // });
    //
    //
    // socket.on('typing', function () {
    //     if (!whoIsTyping.includes(nickName)) {
    //         whoIsTyping.push(nickName);
    //         console.log('who is typing now');
    //         console.log(whoIsTyping);
    //         io.to("room" + now_room_idx).emit('typing', whoIsTyping);
    //     }
    // });
    //
    // socket.on('quitTyping', function () {
    //     if (whoIsTyping.length == 0) {
    //         //if it's empty
    //         console.log('emit endTyping');
    //         io.emit('endTyping');
    //     } else {
    //         //if someone else is typing
    //         var index = whoIsTyping.indexOf(nickName);
    //         console.log(index);
    //         if (index != -1) {
    //             whoIsTyping.splice(index, 1);
    //             if (whoIsTyping.length == 0) {
    //
    //                 console.log('emit endTyping');
    //                 io.emit('endTyping');
    //
    //             } else {
    //                 io.emit('typing', whoIsTyping);
    //                 console.log('emit quitTyping');
    //                 console.log('whoIsTyping after quit');
    //                 console.log(whoIsTyping);
    //             }
    //
    //         }
    //
    //     }
    // });
    //
    // //disconnect is in socket
    // socket.on('disconnect', function () {
    //
    //     tmp_nick = [];
    //
    //     console.log(nickName + ' : DISCONNECTED');
    //
    //     console.log(now_room_idx);
    //
    //     console.log(room_in_user[now_room_idx] + " 변경 전");
    //
    //
    //     for (var key in room_in_user[now_room_idx]) {
    //         if (room_in_user[now_room_idx][key] != nickName) {
    //             tmp_nick.push(room_in_user[now_room_idx][key]);
    //         }
    //     }
    //
    //     room_in_user[now_room_idx] = tmp_nick;
    //
    //     console.log(room_in_user[now_room_idx] + " 변경 후");
    //
    //     // whoIsOn.splice(whoIsOn.indexOf(nickName), 1);
    //
    //     io.to("room" + now_room_idx).emit('logout', {nickNameArr: room_in_user[now_room_idx], disconnected: nickName});
    //
    //     if (whoIsTyping.length == 0) {
    //         //if it's empty
    //         io.emit('endTyping');
    //     } else {
    //         //if someone was typing
    //         var index = whoIsTyping.indexOf(nickName);
    //         if (index != -1) {
    //             whoIsTyping.splice(index, 1);
    //
    //             //if no one is typing now
    //             if (whoIsTyping.length == 0) {
    //                 io.emit('endTyping');
    //             }
    //
    //             //if someone else is still typing
    //             else {
    //                 io.emit('typing', whoIsTyping);
    //                 console.log('emit popTyping');
    //                 console.log(whoIsTyping);
    //             }
    //
    //         }
    //
    //     }
    // });
});

