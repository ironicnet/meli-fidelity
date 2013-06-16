<?php use_helper('I18N', 'Date') ?>
<?php include_partial('csSetting/assets') ?>
<?php include_partial('csSetting/header') ?>

<div class='container-fluid'>
  <div class="row-fluid">

    <?php if ($sidebar_status): ?>
      <?php include_partial('csSetting/list_sidebar', array('configuration' => $configuration)) ?>
    <?php endif; ?>

<div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">


    <h1 style="display: inline">Contenidos</h1>

    <?php include_partial('csSetting/flashes') ?>

    <div id="sf_admin_header">
      <?php include_partial('csSetting/list_header', array('pager' => $pager)) ?>
    </div>



   <div id="sf_admin_content">
     <form action="<?php echo url_for('@cs_setting_save_all'); ?>" method="post" enctype="multipart/form-data">
       <?php if ($form->isCSRFProtected()) : ?>
         <?php echo $form['_csrf_token']->render(); ?>
       <?php endif; ?>
  
       <?php include_partial('csSetting/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'form' => $form)) ?>
        <div>
         <?php include_partial('csSetting/list_batch_actions', array('helper' => $helper)) ?>
          <?php include_partial('csSetting/list_actions', array('helper' => $helper)) ?>
</div>
     </form>
      <form class="form-inline" method="get" action="<?php echo url_for('cs_setting') ?>">
                    <div class="well pull-right">
                        <?php $select = new sfWidgetFormChoice(array(
                                        'multiple' => false,
                                        'expanded' => false,
                                        'choices' => array('15' => __('Max per page', null, 'tmcTwitterBootstrapPlugin'), 5 => 5, 10 => 10, 20 => 20, 50 => 50)
                                    ),
                                    array('class' => 'input-medium')); echo $select->render('max_per_page') ?>
                        <input type="submit" class="btn btn-inverse btn-small" value="<?php echo __('Go', array(), 'tmcTwitterBootstrapPlugin') ?>" />
                    </div>
                </form>
    </div>
<div class="clearfix"></div>

    <div id="sf_admin_footer">
      <?php include_partial('csSetting/list_footer', array('pager' => $pager)) ?>
    </div>
  
</div>

  </div>
</div>

<?php include_partial('csSetting/footer') ?>
