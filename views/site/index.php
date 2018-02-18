<?php 

use yii\helpers\Html;
use yii\helpers\Url;


$js = <<<JS
$('#chat-form').submit(function() {

     var form = $(this);

     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               $("#teks-field").val("");
          }
     });

     return false;
});



JS;
$this->registerJs($js, \yii\web\View::POS_READY)
?>


<style type="text/css">
    .friend {
        background: #efefef;
        width: 80%;
        padding: 3px 10px 3px 10px;
        border-radius: 7px
    }

    .me {
        text-align: right;
        background: #71c7a0;
        width: 80%;
        margin-left: 20% !important;
        padding: 3px 10px 3px 10px;
        border-radius: 7px
    }   
</style>

<div class="box box-success">
    <div class="box-header">
        <i class="fa fa-comments-o"></i>
        <h3 class="box-title">Chat</h3>
        <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
            <div class="btn-group" data-toggle="btn-toggle" >
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-green"></i></button>
                <a href="<?= Url::to(['chat/truncate']); ?>" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></a>
            </div>
        </div>
    </div>

    <?= Html::beginForm(['site/index'], 'POST', [
        'id' => 'chat-form'
    ]) ?>

        <div class="box-body chat" id="chat-box">
            <!-- chat item -->
            <?php foreach ($query as $chat):
                if ($chat->user == Yii::$app->user->id) {
                    $avatar = false;
                    $class = 'me';
                } else{
                    $avatar = true;
                    $class = 'friend';                    
                }
            ?>                
                
                <div class="item">
                    <?php if ($avatar): ?>
                        <img src="img/avatar.png" alt="user image" class="online"/>
                    <?php endif ?>
                    <p class="message <?= $class; ?>">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                            <?= $chat->user; ?>
                        </a>
                        <?= $chat->user; ?>
                    </p>
                </div>
            <?php endforeach ?>
            <div id="append" style="color: red"></div>
        </div><!-- /.chat -->
        <div class="box-footer">
            <div class="input-group">
                    <?= Html::textInput('teks', null, [
                        'id' => 'teks-field',
                        'class' => 'form-control',
                        'placeholder' => 'Ketikan Pesan..'
                    ]) ?>                
                <div class="input-group-btn">
                    <?= Html::submitButton('Kirim', [
                        'class' => 'btn btn-block btn-success'
                    ]) ?>                    
                </div>
            </div>
        </div>
    <?= Html::endForm() ?>        
</div><!-- /.box (chat box) -->

<script type="text/javascript">
$( document ).ready(function() {

    var socket = io.connect('http://localhost:8890');

    socket.on('chat', function (data) {

        var message = JSON.parse(data);

        if (message.teks == 'dadan') {
            notifyMe();
        }

        session = <?php print Yii::$app->user->id; ?>

        if (message.user == session) {
          content_class = 'me';
        } else{
          content_class = 'friend';
        }

        $( "#append" ).append(
              '<div class="item">' +
                    '<div>&nbsp;</div>' +
                    '<div>&nbsp;</div>' +
                    '<p class="message '+content_class+'">' +
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
</script>
