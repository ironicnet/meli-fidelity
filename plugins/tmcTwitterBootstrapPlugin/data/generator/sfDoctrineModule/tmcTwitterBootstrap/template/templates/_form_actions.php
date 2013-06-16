<div class="btn-group">
    <?php foreach (array('new', 'edit') as $action): ?>
        <?php if ('new' == $action): ?>
            [?php if ($form->isNew()): ?]
        <?php else: ?>
            [?php else: ?]
        <?php endif; ?>

        <?php $actions = $this->configuration->getValue($action.'.actions') ?>

        <?php if (array_key_exists('_list', $actions)): ?>
                <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($actions['_list']).') ?]', $actions['_list']) ?>
            <?php unset($actions['_list']) ?>
        <?php endif; ?>

        <?php if (array_key_exists('_save', $actions) || array_key_exists('_save_and_add', $actions)): ?>
                <?php if (array_key_exists('_save', $actions)): ?>
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($actions['_save']).') ?]', $actions['_save']) ?>
                    <?php unset($actions['_save']) ?>
                <?php endif ?>
                <?php if (array_key_exists('_save_and_add', $actions)): ?>
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSaveAndAdd($form->getObject(), '.$this->asPhp($actions['_save_and_add']).') ?]', $actions['_save_and_add']) ?>
                    <?php unset($actions['_save_and_add']) ?>
                <?php endif; ?>
        <?php endif; ?>

        <?php if (count($actions) > 0 ): ?>
            <?php foreach ($actions as $name => $params): ?>
                <?php if ('_delete' == $name): ?>
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
                <?php elseif ('_show' == $name): ?>
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
                <?php else: ?>
                    [?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
                        <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
                    [?php else: ?]
                        <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
                    [?php endif; ?]
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    <?php endforeach; ?>
            [?php endif; ?]
</div>
