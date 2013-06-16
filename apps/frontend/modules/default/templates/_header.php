<div class="navbar navbar-fixed-top navbar-inverse">
   <div class="navbar-inner">

      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
         <span class="icon-bar"></span> 
         <span class="icon-bar"></span> 
         <span class="icon-bar"></span> 
      </a> 

      <div class="container">

         <a class="brand" href="/">Fidelity App</a>

         <?php if($user = $sf_user->getMELIUser()): ?>

         <div class="nav-collapse collapse">
            <!--<ul class="nav">
               <li><a href="<?php //echo url_for("@items"); ?>">Mis publicaciones</a></li>
               <li><a href="<?php //echo url_for("@orders"); ?>">Mis compras</a></li>
            </ul>-->

            <ul class="nav pull-right">
               <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-user"></i> <?php echo $user->nickname; ?> <b class="caret"></b>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="<?php echo $sf_user->getMELI()->getLogoutUrl(); ?>"><i class="icon-signout"></i> Salir</a></li>
               </ul>
               </li>
            </ul>

         </div>

         <?php endif; ?>
      </div>
   </div>
</div>
