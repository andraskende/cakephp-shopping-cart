<h2>Admin Edit Tag</h2>



<div class="row">
    <div class="col-sm-4">

        <?php echo $this->Form->create('Tag'); ?>
        <?php echo $this->Form->input('id'); ?>

        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>

        <br />

        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

<br />
<br />


<h3>Actions</h3>

<br />

<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $this->Form->value('Tag.id')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Tag.id'))); ?>

<br />
<br />