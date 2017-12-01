<h2>Admin Edit Category</h2>

<div class="row">

    <div class="col col-lg-3">

        <?php echo $this->Form->create('Category'); ?>
        <?php echo $this->Form->input('id'); ?>
        <br />
        <?php echo $this->Form->input('parent_id', array('class' => 'form-control', 'empty' => true)); ?>
        <br />
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>

</div>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $this->Form->value('Category.id')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Category.id'))); ?>

<br />
<br />
