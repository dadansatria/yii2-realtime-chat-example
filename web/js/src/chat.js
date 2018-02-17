$( document ).ready(function() {

    var socket = io.connect('http://localhost:8890');

    socket.on('notification', function (data) {

        var message = JSON.parse(data);

        if (message.message == 'dadan') {
        	notifyMe();
        }

        $( "#id_user" ).prepend(message.name);
        $( "#teks" ).prepend( message.message);

    });

});

function notifyMe() {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Notification title', {
      icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
      body: "Hey there! You've been notified!",
    });

    notification.onclick = function () {
      window.open("http://stackoverflow.com/a/13328397/1269037");      
    };

  }

}