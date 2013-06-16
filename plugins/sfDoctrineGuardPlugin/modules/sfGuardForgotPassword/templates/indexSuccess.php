<?php use_helper('I18N') ?>
<h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>

<p>
  <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?>
  <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
</p>

<?php include_partial("sfGuardForgotPassword/requestForm", array("form" => $form)); ?>