<?php if (count($errors=$form->getGlobalErrors()) > 0): ?>
<div class="control-group error">
    <ul class="error_list">
    <?php foreach ($errors as $error): ?>
        <li><?php echo __($error, null, 'tmcTwitterBootstrapPlugin') ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif ?>

<form class="form-horizontal" action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
    <?php echo $form->renderHiddenFields() ?>

    <div class="control-group<?php echo $form['email_address']->hasError() ? ' error' : ''?>">
        <?php echo $form['email_address']->renderLabel(null, array('class' => $form['email_address']->hasError() ? 'strong' : '')) ?>
        <?php if ($form['email_address']->hasError()): ?>
            <span class="help-block"><?php echo $form['email_address']->renderError() ?></span>
        <?php endif ?>
        <?php echo $form['email_address']->render(array('class' => 'input-xlarge')) ?>
    </div>
    
    <input class="btn" type="submit" name="change" value="<?php echo __('Request', null, 'sf_guard') ?>" />
</form>
