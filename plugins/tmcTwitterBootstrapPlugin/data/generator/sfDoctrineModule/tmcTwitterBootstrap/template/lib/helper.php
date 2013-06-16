[?php

/**
* <?php echo $this->getModuleName() ?> module configuration.
*
* @package    ##PROJECT_NAME##
* @subpackage <?php echo $this->getModuleName()."\n" ?>
* @author     ##AUTHOR_NAME##
* @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
*/
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
   public function getUrlForAction($action)
   {
      return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
   }

   public function linkToDelete($object, $params)
   {
      if ($object->isNew())
      {
         return '';
      }

      return link_to('<i class="icon-trash icon-white"></i>', $this->getUrlForAction('delete'), $object, array(
         'method' => 'delete', 
         'class' => 
         'btn btn-small btn-danger', 
         'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'tmcTwitterBootstrapPlugin') : $params['confirm'],
         'rel' => 'tooltip',
         'title' => __($params['label'], array(), 'tmcTwitterBootstrapPlugin')
      ));
   }

   public function linkToEdit($object, $params)
   {
      return link_to('<i class="icon-pencil icon-black"></i>', $this->getUrlForAction('edit'), $object, array(
         'class' => 'btn btn-small',
         'rel' => 'tooltip',
         'title' => __($params['label'], array(), 'tmcTwitterBootstrapPlugin')
      ));
   }

   public function linkToPromote($object, $params)
   {
      return link_to('<i class="icon-arrow-up icon-black"></i> '.__($params['label'], array(), 'tmcTwitterBootstrapPlugin'), $this->getUrlForAction('promote'), $object, array('class' => 'btn btn-small'));
   }
   
   public function linkToDemote($object, $params)
   {
      return link_to('<i class="icon-arrow-down icon-black"></i> '.__($params['label'], array(), 'tmcTwitterBootstrapPlugin'), $this->getUrlForAction('demote'), $object, array('class' => 'btn btn-small'));
   }

    public function linkToImport($params)
   {
      return link_to('<i class="icon-upload icon-white"></i> '.__($params['label'], array(), 'tmcTwitterBootstrapPlugin'), '@'.$this->getUrlForAction('import'), array('class' => 'btn btn-success btn-small'));
   }


   public function linkToShow($object, $params)
   {
      return link_to('<i class="icon-search icon-black"></i>', $this->getUrlForAction('show'), $object, array(
         'class' => 'btn btn-small',
         'rel' => 'tooltip',
         'title' => __($params['label'], array(), 'tmcTwitterBootstrapPlugin')
      ));
   }

   public function linkToSave($object, $params)
   {
      return '<button class="btn btn-small btn-success" type="submit"><i class="icon-ok"></i> ' . __($params['label'], array(), 'tmcTwitterBootstrapPlugin') . '</button>';
   }
   public function linkToNew($params)
   {
      return link_to('<i class="icon-plus icon-white"></i>', '@'.$this->getUrlForAction('new'), array(
         'class' => 'btn btn-success btn-small',
         'rel' => 'tooltip',
         'data-toggle' => 'tooltip',
         'title' => __($params['label'])
      ));
   }
   public function linkToSaveAndAdd($object, $params)
   {
      if (!$object->isNew())
      {
         return '';
      }

      return '<button class="btn btn-small btn-success" name="_save_and_add" type="submit"><i class="icon-plus"></i> ' . __($params['label'], array(), 'tmcTwitterBootstrapPlugin') . '</button>';
   }
   public function linkToList($params)
   {
      return link_to('<i class="icon-arrow-left icon-black"></i> '.__($params['label'], array(), 'tmcTwitterBootstrapPlugin'), '@'.$this->getUrlForAction('list'), array('class' => 'btn btn-small'));
   }
   public function linkToFilters()
   {
      return '<a class="btn btn-small" data-toggle="modal" href="#filters" ><i class="icon-search icon-black"></i></a>';
   }
}
