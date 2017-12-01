<?php if($ajax != 1): ?>

<?php $this->Html->addCrumb('Search'); ?>

<h1>Search</h1>

<br />

<?php echo $this->Form->create('Product', ['type' => 'GET']); ?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('search', ['label' => false, 'div' => false, 'class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'value' => $search]); ?>
    </div>
    <div class="col-sm-3">
        <?php echo $this->Form->button('Search', ['div' => false, 'class' => 'btn btn-sm btn-primary']); ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>


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

