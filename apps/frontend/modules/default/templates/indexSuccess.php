<?php if($sf_user->getMELIUser()): ?>

<div class="row-fluid">
   <div class="span12">
      <h3><i class="icon-usd"></i> Compras</h3>

      <?php if($orders): ?>

      <table class="table">
         <thead>
            <tr>
               <th></th>
               <th>Producto</th>
               <th>Comprado</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($orders->getRawValue() as $order): ?>
            <tr>
               <td><img style="border: 1px solid #ccc;" src="<?php echo $order['thumbnail'] ? $order['thumbnail'] : "http://static.mlstatic.com/org-img/original/MLA/artsinfoto.gif"; ?>" /></td>
               <td><?php echo link_to($order['title'], "@order_detail?id=" . $order['meli_order_id']); ?><br /><?php echo format_currency($order['unit_price'], $order['currency_id']); ?></td>
               <td><i class="icon-time"></i> <?php echo time_ago_in_words(strtotime($order['date_created'])); ?><td>
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
            <h3><i class="icon-money"></i> Ventas</h3>

            <?php if($sales): ?>

            <table class="table">
               <thead>
                  <tr>
                     <th></th>
                     <th>Producto</th>
                     <th>Comprador</th>
                     <th>Vendido</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($sales as $sale): ?>
                  <tr>
                     <td><img style="border: 1px solid #ccc;" src="<?php echo $sale['thumbnail'] ? $sale['thumbnail'] : "http://static.mlstatic.com/org-img/original/MLA/artsinfoto.gif"; ?>" /></td>
                     <td><?php echo link_to($sale['title'], "@order_detail?id=" . $sale['meli_order_id']); ?><br /><?php echo $sale['unit_price'] ? format_currency($sale['unit_price'], $sale['currency_id']) : "-"; ?></td>
                     <td><i class="icon-user"></i> <?php echo $sale['buyer_nickname']; ?></td>
                     <td><i class="icon-time"></i> <?php echo time_ago_in_words(strtotime($sale['date_created'])); ?></td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>

            <?php else: ?>

            <div class="alert alert-info">No hay ventas recientes</div>

            <?php endif; ?>

         </div>
      </div>

      <?php else: ?>
      <a  style="margin-top: 50px; " class="btn btn-success btn-xlarge btn-block" href="<?php echo $sf_user->getMELI()->getLoginUrl(); ?>"><i class="icon-user"></i> Login con Mercado Libre</a>
      <?php endif; ?>
