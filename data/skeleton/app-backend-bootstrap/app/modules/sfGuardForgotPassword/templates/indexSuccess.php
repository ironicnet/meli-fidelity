<?php use_helper('I18N') ?>

<?php include_partial('tmcTwitterBootstrap/assets') ?>
<?php include_partial('header') ?>

<div id="login" class="container">
    <div class="hero-unit">
        <div class="pull-left login-left">
            <?php include_partial('logo') ?>
        </div>
        <div class="pull-left login-right">
            <h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>
           

            <?php include_partial('alerts') ?>

            <?php include_partial("sfGuardForgotPassword/requestForm", array("form" => $form)); ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php include_component('tmcTwitterBootstrap', 'footer') ?>
