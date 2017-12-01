<?php if($ajax != 1): ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<?php echo $this->Html->script(array('search.js'), array('inline' => false)); ?>

<?php $this->Html->addCrumb('Search'); ?>

<h1>Search</h1>

<br />

<div class="row">

<?php echo $this->Form->create('Product', ['type' => 'GET']); ?>

<div class="col col-sm-4">
    <?php echo $this->Form->input('search', ['label' => false, 'div' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'value' => $search]); ?>
</div>

<div class="col col-sm-3">
    <?php echo $this->Form->button('Search', ['div' => false, 'class' => 'btn btn-sm btn-primary']); ?>
</div>

<?php echo $this->Form->end(); ?>

</div>

<br />
<br />

<?php endif; ?>

<?php // echo $this->Html->script('search.js', array('inline' => false)); ?>

<?php if(!empty($search)) : ?>

<?php $this->Html->addCrumb($search); ?>

<?php if(!empty($products)) : ?>

<?php echo $this->element('products'); ?>

<br />
<br />
<br />

<?php else: ?>

<h3>No Results</h3>

<?php endif; ?>
<?php endif; ?>

