<?php if($sf_user->getMELIUser()): ?>

<div class="row-fluid">
   <div class="span12">
      <h4>Mis compras</h4>

      <?php if($orders): ?>

      <table class="table">
         <thead>
            <tr>
               <th>Producto</th>
               <th>Precio</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($orders->getRawValue() as $order): ?>
            <tr>
               <td><?php echo $order->order_items[0]->item->title; ?></td>
               <td><?php echo format_currency($order->order_items[0]->unit_price, $order->order_items[0]->currency_id); ?></td>
               <td><td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>

            <?php else: ?>

            <div class="alert alert-info">No se encontraron compras realizadas</div>

            <?php endif; ?>

         </div>
      </div>


      <div class="row-fluid">
         <div class="span12">
            <h4>Mis publicaciones</h4>

            <?php if($publications): ?>

            <table class="table">
               <thead>
                  <tr>
                     <th>Producto</th>
                     <th>Precio</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($publications as $publication): ?>
                  <tr>
                     <td>Producto 1</td>
                     <td>Precio 1</td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>

            <?php else: ?>

            <div class="alert alert-info">No se encontraron publicaciones</div>

            <?php endif; ?>

         </div>
      </div>

      <?php else: ?>
      <a class="btn btn-success btn-xlarge" href="<?php echo $sf_user->getMELI()->getLoginUrl(); ?>"><i class="icon-user"></i> Login con Mercado Libre</a>
      <?php endif; ?>
