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
            <?php foreach ($query as $chat): ?>
                <div class="item">
                    <img src="img/avatar.png" alt="user image" class="online"/>
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                            <?= $chat->user; ?>
                        </a>
                        <?= $chat->teks; ?>
                    </p>
                </div>
            <?php endforeach ?>
            <div id="append"></div>
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