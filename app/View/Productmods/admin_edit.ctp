<h2>Admin Edit Productmod</h2>

<br />

<div class="row">
    <div class="col-sm-4">

        <?php echo $this->Form->create('Productmod'); ?>
        <?php echo $this->Form->input('id'); ?>
        <br />
        <?php echo $this->Form->input('product_id', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('sku', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('weight', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('price', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

<br />
<br />
