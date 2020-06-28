var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);

var no = 1;
io.on('connection', function (socket) {
    no++;
    console.log(no + "New client connected");

    var redisClient = redis.createClient();

    redisClient.subscribe('chat');

    redisClient.on("message", function(channel, message) {
        console.log("New message: " + message + ". In channel: " + channel);
        socket.emit(channel, message);
    });

    socket.on('disconnect', function() {
        redisClient.quit();
    });

});