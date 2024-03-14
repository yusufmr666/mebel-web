<link href="<?= base_url() ?>/assets/css/chatcss.css" rel="stylesheet">
<link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

<header class="page-header">
  <div class="container ">
        <div class="row">
        <div class="col-md-1">
        <a type="button" class="btn btn-success" href="<?=base_url()?>user/home">Back</a>
        </div>
        <div class="col-md-10 text-center">
            <h2><?= $name?></h2>
        </div>
        </div>    
  </div>
</header>
<div class="main">
  <div class="container">
    <div class="chat-log">
    <?php foreach ($datas as $no => $kel) : ?>
      <?php
        if ($kel['id_level'] == 'admin') {?>
      <div class="chat-log__item">
        <h3 class="chat-log__author">admin <small><?= date('h:i a', strtotime($kel['date']))?></small></h3>
        <div class="chat-log__message"><?= $kel['faq']?></div>
      </div>
      <?php } else {?>
      <div class="chat-log__item chat-log__item--own">
        <h3 class="chat-log__author"><?= $name?> <small><?= date('h:i a', strtotime($kel['date']))?></small></h3>
        <div class="chat-log__message"><?=$kel['faq']?></div>
      </div>
      <?php }
       endforeach?>
    </div>
  
  </div>
  <div class="chat-form">
    <div class="container ">
      <form class="form-horizontal" action="<?= base_url("user/chat/add")?>" method="post">
        <div class="row">
          <div class="col-sm-11 col-xs-8">
            <input type="text" name="faq" class="form-control" id="" placeholder="Message" />
          </div>
          <div class="col-sm-1 col-xs-4">
            <button type="submit" class="btn btn-success btn-block">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

