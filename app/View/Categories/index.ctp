<h2>Categories</h2>

<?php $this->Html->addCrumb('Categories'); ?>

<?php echo $this->Tree->generate($categories, array('element' => 'categories/tree_item', 'class' => 'categorytree', 'id' => 'categorytree')); ?>