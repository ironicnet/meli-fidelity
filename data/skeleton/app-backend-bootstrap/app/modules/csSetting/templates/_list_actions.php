<div class="well pull-left">
  <div class="btn-group">
  <input class="btn btn-success margin-right" type="submit" name="submit" value="Guardar cambios">
<?php if (csSettings::isAuthenticated($sf_user)): ?>
  <?php //echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>
<?php endif ?>
</div>
</div>
