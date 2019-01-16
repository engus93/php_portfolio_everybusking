var express = require('express');
var app = new express();
var http = require('http').createServer(app);
var io = require("socket.io")(http);

var log = require('log');

var port = process.env.PORT || 3000;

app.use(express.static(__dirname + "/public"));

app.get('/', function (req,res) {
    res.redirect('index.html')
});

io.on('connection', function (socket) {
    socket.on('stream', function (image) {
        socket.broadcast.emit('stream', image);
    });
});

http.listen(port,function () {
    log('Servidor escuchando a traves del puerto %s', port);
});