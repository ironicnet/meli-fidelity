<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>

<?php $results = $pager->getResults()->getRawValue() ?>
    <?php $modelname = get_class($results[0]) ?>
     
<table class="datatable table table-bordered table-striped" id="table_press_item" style="margin-top: 5px !important;">
       <thead>
         <tr>
          <?php include_partial('csSetting/list_th_tabular', array('sort' => $sort)) ?>
          <!--<th id="sf_admin_list_th_actions">
          <?php if (csSettings::isAuthenticated($sf_user)): ?>
            <?php echo __('Actions', array(), 'sf_admin') ?>
          <?php endif ?>
          </th>-->
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="2">

            <?php if ($pager->haveToPaginate()): ?>
            <div style="position: relative; width: auto; float:right"><?php include_partial('csSetting/pagination', array('pager' => $pager)) ?></div>
            <?php slot('pagination_extra') ?>
            <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'tmcTwitterBootstrapPlugin') ?>
            <?php end_slot() ?>
            <?php endif; ?>
            <div style="float: left;font-weight: bold;line-height: 34px;margin-left: 10px;position: relative;width: auto;">
              <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'tmcTwitterBootstrapPlugin') ?>
              <?php include_slot('pagination_extra') ?>
            </div>
          
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php $group = '' ?>
        <?php foreach ($pager->getResults() as $i => $cs_setting): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <?php if ($cs_setting['group'] != $group): ?>
            <tr class="sf_admin_row sf_admin_list_th_name sf_admin_setting_group">
              <th colspan="3">
                <?php echo $cs_setting['group'] ?>
              </th>
            </tr>
          <?php endif ?>
          <?php $group = $cs_setting->getGroup(); ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('csSetting/list_td_tabular', array('cs_setting' => $cs_setting, 'form' => $form)) ?>
            <?php include_partial('csSetting/list_td_actions', array('cs_setting' => $cs_setting, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
