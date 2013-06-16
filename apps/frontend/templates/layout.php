<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <?php include_http_metas() ?>
      <?php include_metas() ?>
      <?php include_title() ?>
      <?php include_stylesheets() ?>
   </head>
   <body>
      <?php include_partial("default/header"); ?>

      <div class="container">
         <?php echo $sf_content ?>
      </div>

      <?php include_javascripts() ?>
      <?php include_slot('after_javascripts') ?>
   </body>
</html>
