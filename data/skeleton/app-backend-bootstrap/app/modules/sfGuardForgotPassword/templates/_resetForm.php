<?php if (count($errors=$form->getGlobalErrors()) > 0): ?>
<div class="control-group error">
    <ul class="error_list">
    <?php foreach ($errors as $error): ?>
        <li><?php echo __($error, null, 'tmcTwitterBootstrapPlugin') ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif ?>

<form action="<?php echo url_for('@sf_guard_forgot_password_change?unique_key='.$sf_request->getParameter('unique_key')) ?>" method="POST">

<?php echo $form->renderHiddenFields() ?>

    <div class="control-group<?php echo $form['password']->hasError() ? ' error' : ''?>">
        <?php echo $form['password']->renderLabel(null, array('class' => $form['password']->hasError() ? 'strong' : '')) ?>
        <?php if ($form['password']->hasError()): ?>
            <span class="help-block"><?php echo $form['password']->renderError() ?></span>
        <?php endif ?>
        <?php echo $form['password']->render(array('class' => 'input-xlarge')) ?>
    </div>

<div class="control-group<?php echo $form['password_again']->hasError() ? ' error' : ''?>">
        <?php echo $form['password_again']->renderLabel(null, array('class' => $form['password_again']->hasError() ? 'strong' : '')) ?>
        <?php if ($form['password_again']->hasError()): ?>
            <span class="help-block"><?php echo $form['password_again']->renderError() ?></span>
        <?php endif ?>
        <?php echo $form['password_again']->render(array('class' => 'input-xlarge')) ?>
    </div>


 <input class="btn" type="submit" name="change" value="<?php echo __('Change', null, 'sf_guard') ?>" />

</form>
