<?php include_partial('tmcTwitterBootstrap/assets') ?>
<?php include_component('tmcTwitterBootstrap', 'header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="hero-unit">
               <h1><?php echo sfConfig::get("app_tmcTwitterBootstrapPlugin_dashboard_name"); ?></h1>
               <p>Bienvenido/a al panel de administración de contenidos de <?php echo sfConfig::get("app_tmcTwitterBootstrapPlugin_dashboard_name"); ?>.</p>
            </div>
        </div>
    </div>
</div>

<?php include_component('tmcTwitterBootstrap', 'footer') ?>
