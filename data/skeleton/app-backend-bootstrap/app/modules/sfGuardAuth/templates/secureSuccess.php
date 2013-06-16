<?php use_helper('I18N') ?>

<?php include_partial('tmcTwitterBootstrap/assets') ?>
<?php include_component('tmcTwitterBootstrap', 'header') ?>

<div id="login" class="container">
    <div class="hero-unit">
        <div class="pull-left login-left">
            <?php include_partial('logo') ?>
        </div>
        <div class="pull-left login-right">
            <h2><?php echo __('Administration area', null, 'tmcTwitterBootstrapPlugin') ?></span></h2>
            <p class="error_list"><?php echo __('Oops! The page you asked for is secure and you do not have proper credentials.', null, 'tmcTwitterBootstrapPlugin') ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
