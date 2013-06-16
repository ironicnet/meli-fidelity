[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div class="sf_admin_form">
   [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', array('id' => ($form->getName() . '_' . ($form->isNew() ? 'new' : 'edit')), 'class' => 'form-horizontal form-inline')) ?]
   [?php echo $form->renderHiddenFields(false) ?]

   [?php if ($form->hasGlobalErrors()): ?]
   [?php echo $form->renderGlobalErrors() ?]
   [?php endif; ?]

   <div class="actions control-group">
      [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
   </div>


   [?php $form_fields = $configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit'); ?]

   [?php if(count($form_fields) > 1): ?]

   <ul class="nav nav-tabs" id="tabs_[?php echo $form->getName(); ?]">
      [?php 
      $i = 0;
      foreach ($form_fields as $fieldset => $fields): 
      ?]
      <li [?php if($i == 0): ?] class="active" [?php endif; ?]><a data-toggle="tab" href="#[?php echo $form->getName() . '_' . $fieldset; ?]">[?php echo $fieldset; ?]</a></li>   
      [?php 
      $i++;
      endforeach; 
      ?]
   </ul>

   <div class="tab-content">
      [?php 
      $i = 0;
      foreach ($form_fields as $fieldset => $fields): ?]
      <div id="[?php echo $form->getName() . '_' . $fieldset; ?]" class="tab-pane[?php if($i == 0): ?] active[?php endif; ?]">
         [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
      </div>
      [?php 
      $i++;
      endforeach; 
      ?]
   </div>

   [?php else: ?]

   [?php foreach ($form_fields as $fieldset => $fields): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
   [?php endforeach; ?]

   [?php endif; ?]

   <div class="actions control-group">
      [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
   </div>
</form>
</div>
