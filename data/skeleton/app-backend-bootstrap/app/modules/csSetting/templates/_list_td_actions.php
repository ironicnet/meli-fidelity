<!--<td nowrap="nowrap">
<div class="btn-group">
    <?php if (csSettings::isAuthenticated($sf_user)): ?>
      <?php echo $helper->linkToEdit($cs_setting, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
      <?php echo $helper->linkToDelete($cs_setting, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php endif ?>
      <?php echo link_to(__('Restore Default', array(), 'messages'), 'csSetting/ListRestoreDefault?id='.$cs_setting->getId(), array('class' => 'btn', 'confirm' => 'Are you sure?')) ?>
</div>
</td>-->
