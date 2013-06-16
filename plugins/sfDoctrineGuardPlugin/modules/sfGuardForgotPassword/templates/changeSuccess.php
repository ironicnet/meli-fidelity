<?php use_helper('I18N') ?>
<h2><?php echo __('Hello %name%', array('%name%' => $user->getName()), 'sf_guard') ?></h2>

<h3><?php echo __('Enter your new password in the form below.', null, 'sf_guard') ?></h3>

<?php include_partial("sfGuardForgotPassword/resetForm", array("form" => $form)); ?>