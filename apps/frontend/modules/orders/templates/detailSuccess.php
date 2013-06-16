<div class="row-fluid">
   <div class="span12">
      <h3><?php echo $order['title']; ?></h3>
   </div>
</div>

<div class="row-fluid">
   <div class="span12">
      <img class="pull-left" style="margin-right: 15px; border: 1px solid #ccc;" src="<?php echo $order['thumbnail'] ? $order['thumbnail'] : "http://static.mlstatic.com/org-img/original/MLA/artsinfoto.gif"; ?>" />

      <?php if($order['seller_id'] != $sf_user->getMELIUserId()): ?>
      <p><i class="icon-user"></i> Vendedor:<?php echo $order['seller_nickname']; ?></p>
      <?php endif; ?>

      <?php if($order['buyer_id'] != $sf_user->getMELIUserId()): ?>
      <p><i class="icon-user"></i> Comprador: <?php echo $order['buyer_nickname']; ?></p>
      <?php endif; ?>

      <p><i class="icon-time"></i> El <?php echo date("d/m/Y", strtotime($order['date_created'])); ?> a las <?php echo date("H:i", strtotime($order['date_created'])); ?> horas</p>
   </div>
</div>

<hr />

<div class="row-fluid">
   <div id="messages">
      <?php if($order->getChatMessages()->count() > 0): ?>

      <?php $messages = $order->getChatMessages(); foreach($messages as $message): ?>

      <div class="row-fluid">
      <div class="span12 alert alert-success <?php echo $message->getUserId() == $order['seller_id'] ? "seller" : "buyer"; ?>">
         <p>
            <i class="icon-user"></i> <b><?php echo $message->getUser()->getUsername(); ?></b><br />
            <?php echo $message->getMessage(); ?>
            <br />
            <i><?php echo time_ago_in_words(strtotime($message->getCreatedAt())); ?></i>
         </p>
      </div>
</div>
      <?php endforeach; ?>

      <?php else: ?>

      <div id="no-messages-alert" class="span12 alert alert-info">No hay mensajes aun</div>

      <?php endif; ?>
   </div>
</div>

<div class="row-fluid">
   <form method="post" id="submit-message-form" action="<?php echo url_for("@message_new"); ?>">
      <input type="hidden" value="<?php echo $order['meli_order_id']; ?>" name="message[order_id]" />
      <textarea name="message[message]" id="message-box" class="span12" rows="10" placeholder="Dejar un mensaje"></textarea>
      <div class="clearfix"></div>
      <button class="btn-success btn-large btn-block" id="submit-message" type="submit"><i class="icon-ok"></i> Enviar</button>
   </form>
</div>
