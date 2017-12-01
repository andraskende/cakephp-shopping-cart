<?php $this->Html->addCrumb($brand['Brand']['name']); ?>

<h1><?php echo $brand['Brand']['name']; ?><small> Products</small></h1>

<br />

<?php if (!empty($products)): ?>

<?php echo $this->element('products'); ?>

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<?php endif; ?>
