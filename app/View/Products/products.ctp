<?php $this->Html->addCrumb('Products'); ?>

<h1><?php echo Configure::read('Settings.SHOP_TITLE'); ?></h1>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />

<?php echo $this->element('products'); ?>

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />