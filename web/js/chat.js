$( document ).ready(function() {

    var socket = io.connect('http://localhost:8890');

    socket.on('chat', function (data) {

        var message = JSON.parse(data);

        if (message.teks == 'dadan') {
        	notifyMe();
        }

        $( "#append" ).append(
              '<div class="item">' +
                  '<img src="img/avatar.png" alt="user image" class="online"/>' +
                    '<p class="message">' +
                        '<a href="#" class="name">'+
                            '<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>'+
                            message.user +
                        '</a>' +
                        message.teks +
                    '</p>' +
              '</div>'          
          );

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