<?php if($sf_user->getMELIUser()): ?>

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