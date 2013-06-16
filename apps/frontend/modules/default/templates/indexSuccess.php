<?php if($sf_user->getMELIUser()): ?>

<?php if($orders->count() > 0): ?>

<div class="row-fluid">
   <div class="span12">
      <h4>Mis compras</h4>
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
               <td>Precio 1</td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>

   </div>
</div>

<?php endif; ?>

<div class="row-fluid">
   <div class="span12">
      <h4>Mis publicaciones</h4>
      <table class="table">
         <thead>
            <tr>
               <th>Producto</th>
               <th>Precio</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Producto 1</td>
               <td>Precio 1</td>
            </tr>
            <tr>
               <td>Producto 1</td>
               <td>Precio 1</td>
            </tr>
            <tr>
               <td>Producto 1</td>
               <td>Precio 1</td>
            </tr>
         </tbody>
      </table>
   </div>
</div>

<?php else: ?>
<a class="btn btn-success btn-xlarge" href="<?php echo $sf_user->getMELI()->getLoginUrl(); ?>"><i class="icon-user"></i> Login con Mercado Libre</a>
<?php endif; ?>
