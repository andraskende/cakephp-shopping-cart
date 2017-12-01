<h2>Admin Add Category</h2>

<div class="row">

    <div class="col col-lg-3">

        <?php echo $this->Form->create('Category'); ?>
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