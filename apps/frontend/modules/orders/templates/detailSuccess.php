<div class="row-fluid">
   <div class="span12">
      <h3><?php echo $order['title']; ?></h3>
   </div>
</div>

<div class="row-fluid">
   <div class="span12">
      <img class="pull-left" style="margin-right: 15px; border: 1px solid #ccc;" src="<?php echo $order['thumbnail'] ? $order['thumbnail'] : "http://static.mlstatic.com/org-img/original/MLA/artsinfoto.gif"; ?>" />
      <p><i class="icon-user"></i> Vendedor:<?php echo $order['seller_nickname']; ?></p>
      <p><i class="icon-user"></i> Comprador: <?php echo $order['buyer_nickname']; ?></p>
      <p><i class="icon-time"></i> El <?php echo date("d/m/Y", strtotime($order['date_created'])); ?> a las <?php echo date("H:i", strtotime($order['date_created'])); ?> horas</p>
   </div>
</div>

<hr />

<div class="row-fluid">
   <?php if($order->getChatMessages()->count() > 0): ?>

   <?php $messages = $order->getChatMessages(); foreach($messages as $message): ?>

   

   <?php endforeach; ?>

   <?php else: ?>

   <div class="span12 alert alert-info">No hay mensajes aun</div>

   <?php endif; ?>
</div>

<div class="row-fluid">
   <textarea class="span12" rows="10">Dejar un comentario</textarea>
   <div class="clearfix"></div>
   <button class="btn-success btn-large btn-block" type="submit">Enviar</button>
</div>
