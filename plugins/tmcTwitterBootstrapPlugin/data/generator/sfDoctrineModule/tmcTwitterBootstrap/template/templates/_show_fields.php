<ul class="nav nav-tabs">
   <?php $i = 0; foreach ($this->configuration->getValue('show.display') as $title => $fields): ?>
   <li<?php if($i == 0): ?> class="active"<?php endif; ?>>
   <a data-toggle="tab" href="#<?php echo $this->getModuleName() . "_" . $title; ?>"><?php echo $title; ?></a>
   </li>
   <?php $i++; endforeach; ?>
</ul>

<div class="tab-content">
<?php $i = 0; foreach ($this->configuration->getValue('show.display') as $title => $fields): ?>

<div class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="<?php echo $this->getModuleName() . "_" . $title; ?>">

   <table class="table table-show table-bordered table-striped" id="show_<?php echo $this->getModuleName() ?>">
   <tbody>
      <?php foreach ($fields as $name => $field): ?>
      <?php if ($field->isPartial()): ?>
      [?php include_partial('<?php echo $this->getModuleName() ?>/<?php echo $name ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      <?php elseif ($field->isComponent()): ?>
      [?php include_component('<?php echo $this->getModuleName() ?>', '<?php echo $name ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
      <?php else: ?>
      <tr>
         <th>[?php echo __('<?php echo $field->getConfig('name', sfInflector::humanize(sfInflector::underscore($name))) ?>', array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</th>
         <?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td class="sf_admin_%s sf_admin_list_th_%s">
   [?php echo %s ?]
</td>
EOF
            , strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig()) ?>
         </tr>
         <?php endif ?>
         <?php endforeach; ?>
      </tbody>
   </table>

</div>

   <?php $i++; endforeach ?>
</div>
