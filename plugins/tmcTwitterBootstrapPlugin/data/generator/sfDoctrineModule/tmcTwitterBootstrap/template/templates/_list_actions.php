<?php if ($actions = $this->configuration->getValue('list.actions') || $this->configuration->hasFilterForm()): ?>
<div class="pull-left">
   <div class="btn-group">

      <?php if($actions = $this->configuration->getValue('list.actions')): ?> 
      <?php foreach ($actions as $name => $params): ?>
      <?php if ('_new' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params)."\n" ?>
      <?php elseif ('_import' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToImport('.$this->asPhp($params).') ?]', $params)."\n" ?>
      <?php else: ?>
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, false), $params)."\n" ?>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php endif; ?>

      <?php if ($this->configuration->hasFilterForm()): ?>
      [?php echo $helper->linkToFilters() ?]
      [?php if ( $sf_user->getAttribute('<?php echo $this->getModuleName() ?>.filters', false, 'admin_module') && $sf_user->getAttribute('<?php echo $this->getModuleName() ?>.filters', false, 'admin_module')->count() > 0 ): ?]
      [?php echo link_to('<i class="icon-remove icon-white"></i> '. __('Reset filter', array(), 'tmcTwitterBootstrapPlugin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post', 'class' => 'btn btn-inverse')) ?]</li>
      [?php endif ?]
      <?php endif; ?>

   </div>
</div>
<?php endif; ?>


