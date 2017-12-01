<h2>Admin Edit User Password</h2>

Username : <?php echo $this->Form->value('User.username'); ?>

<br />

<div class="row">
    <div class="col-sm-4">

        <?php echo $this->Form->create('User');?>
        <?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
        <?php echo $this->Form->input('password', array('class' => 'form-control', 'value' => '')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary'));?>
        <?php echo $this->Form->end();?>

    </div>
</div>