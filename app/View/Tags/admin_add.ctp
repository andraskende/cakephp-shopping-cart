<h2>Admin Add Tag</h2>


<div class="row">
    <div class="col-sm-4">

        <?php echo $this->Form->create('Tag'); ?>

        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>

        <br />

        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

<br />
<br />