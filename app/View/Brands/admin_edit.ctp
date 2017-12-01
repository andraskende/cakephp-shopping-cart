<h2>Admin Edit Brand</h2>

<div class="row">

    <div class="col col-lg-3">

        <?php echo $this->Form->create('Brand'); ?>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>

</div>