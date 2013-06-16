<?php if($sf_user->getMELIUser()): ?>

<div class="row-fluid">
   <div class="span12">
      <h3>Mis compras</h3>

      <?php if($orders): ?>

      <table class="table">
         <thead>
            <tr>
               <th></th>
               <th>Producto</th>
               <th>Precio</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($orders->getRawValue() as $order): ?>
            <tr>
               <td><img src="<?php echo $order['thumbnail']; ?>" /></td>
               <td><?php echo $order['title']; ?></td>
               <td><?php echo format_currency($order['unit_price'], $order['currency_id']); ?></td>
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
            <h3>Mis publicaciones</h3>

            <?php if($publications): ?>

            <table class="table">
               <thead>
                  <tr>
                     <th>Producto</th>
                     <th>En stock</th>
                     <th>Vendidos</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($publications as $publication): ?>
                  <tr>
                     <td><?php echo $publication['title']; ?></td>
                     <td><?php echo $publication['available_quantity']; ?></td>
                     <td><?php echo $publication['sold_quantity']; ?></td>
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
