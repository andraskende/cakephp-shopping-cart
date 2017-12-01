<?php echo $this->set('title_for_layout', 'Address'); ?>

<?php $this->Html->addCrumb('Address'); ?>

<?php echo $this->Html->script(array('shop_address.js'), array('inline' => false)); ?>

<h1>Address</h1>

<?php echo $this->Form->create('Order'); ?>

<hr>

<div class="row">
    <div class="col col-sm-4">

        <?php echo $this->Form->input('first_name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('last_name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('email', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('phone', array('class' => 'form-control')); ?>
        <br />
        <br />

    </div>
    <div class="col col-sm-4">

        <?php echo $this->Form->input('billing_address', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('billing_address2', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('billing_city', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('billing_state', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('billing_zip', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('billing_country', array('class' => 'form-control')); ?>
        <br />
        <br />

        <?php echo $this->Form->input('sameaddress', array('type' => 'checkbox', 'label' => 'Copy Billing Address to Shipping')); ?>

    </div>
    <div class="col col-sm-4">

        <?php echo $this->Form->input('shipping_address', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('shipping_address2', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('shipping_city', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('shipping_state', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('shipping_zip', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('shipping_country', array('class' => 'form-control')); ?>
        <br />
        <br />

    </div>
</div>

<br />

<?php echo $this->Form->button('<i class="fa fa-check"></i> &nbsp; Continue', array('class' => 'btn btn-sm btn-success'));?>
<?php echo $this->Form->end(); ?>

