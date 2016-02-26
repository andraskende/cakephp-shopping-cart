<?php echo $this->set('title_for_layout', 'Order Review'); ?>

<?php $this->Html->addCrumb('Order Review'); ?>

<?php echo $this->Html->script(array('jquery.validate.js', 'additional-methods.js', 'shop_review.js'), array('inline' => false)); ?>

<h1>Review And Place Your Order</h1>

<hr>

<div class="row">
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Customer Info</h3>
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                Email: <?php echo $shop['Order']['email'];?><br />
                Phone: <?php echo $shop['Order']['phone'];?>
            </div>
        </div>
    </div>
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Billing Address</h3>
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                <?php echo $shop['Order']['billing_address'];?><br />
                <?php echo $shop['Order']['billing_address2'];?><br />
                <?php echo $shop['Order']['billing_city'];?>, <?php echo $shop['Order']['billing_state'];?> <?php echo $shop['Order']['billing_zip'];?><br />
                <?php echo $shop['Order']['billing_country'];?>
            </div>
        </div>
    </div>
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Shipping Address</h3>
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                <?php echo $shop['Order']['shipping_address'];?><br />
                <?php echo $shop['Order']['shipping_address2'];?><br />
                <?php echo $shop['Order']['shipping_city'];?>, <?php echo $shop['Order']['shipping_state'];?> <?php echo $shop['Order']['shipping_zip'];?><br />
                <?php echo $shop['Order']['shipping_country'];?>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col col-sm-1">#</div>
    <div class="col col-sm-6">ITEM</div>
    <div class="col col-sm-1">WEIGHT</div>
    <div class="col col-sm-1">WEIGHT</div>
    <div class="col col-sm-1">PRICE</div>
    <div class="col col-sm-1" style="text-align: right;">QUANTITY</div>
    <div class="col col-sm-1" style="text-align: right;">SUBTOTAL</div>
</div>

<br />
<br />

<?php foreach ($shop['OrderItem'] as $item): ?>
<div class="row">
    <div class="col col-sm-1"><?php echo $this->Html->image('/images/small/' . $item['Product']['image'], array('height' => 60, 'class' => 'px60')); ?></div>
    <div class="col col-sm-6">
    <?php echo $item['Product']['name']; ?>
    <?php if(isset($item['Product']['productmod_name'])) : ?>
    <br />
    <small><?php echo $item['Product']['productmod_name']; ?></small>
    <?php endif; ?>
    </div>
    <div class="col col-sm-1"><?php echo $item['Product']['weight']; ?></div>
    <div class="col col-sm-1"><?php echo $item['totalweight']; ?></div>
    <div class="col col-sm-1">$<?php echo $item['Product']['price']; ?></div>
    <div class="col col-sm-1" style="text-align: right;"><?php echo $item['quantity']; ?></div>
    <div class="col col-sm-1" style="text-align: right;">$<?php echo $item['subtotal']; ?></div>
</div>
<?php endforeach; ?>

<hr>

<div class="row">
    <div class="col col-sm-10">Products: <?php echo $shop['Order']['order_item_count']; ?></div>
    <div class="col col-sm-1" style="text-align: right;">Items: <?php echo $shop['Order']['quantity']; ?></div>
    <div class="col col-sm-1" style="text-align: right;">Total<br /><strong>$<?php echo $shop['Order']['total']; ?></strong></div>
</div>

<hr>

<br />
<br />

<?php echo $this->Form->create('Order'); ?>

<?php if((Configure::read('Settings.AUTHORIZENET_ENABLED') == 1) && $shop['Order']['order_type'] == 'creditcard') : ?>

<div class="row">
    <div class="col col-sm-4">

        <strong>Credit or debit card</strong>

        <br />

        <?php echo $this->Form->input('creditcard_number', array('label' => false, 'class' => 'form-control ccinput', 'type' => 'tel', 'maxLength' => 16, 'autocomplete' => 'off')); ?>

    </div>
    <div class="col col-sm-2">

        <strong>Card Security Code</strong>

        <a tabindex="9999" id="cscpop" role="button" data-placement="top" data-toggle="popover" data-trigger="focus" title="Card Security Code (CSC)" data-content="<small><strong>Visa, MasterCard, Discover</strong><br /><img src=<?php echo Router::url('/'); ?>img/visa.png><br / >The security code is the last three digits of the number that appears on the back of your card in the signature bar. <br /><br /><strong>American Express</strong><br /><img src=<?php echo Router::url('/'); ?>img/amex.png><br />The security code is the four digits located on the front of the card, on the right side.</small>"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>

        <br />

        <?php echo $this->Form->input('creditcard_code', array('label' => false, 'class' => 'form-control', 'type' => 'tel', 'maxLength' => 4)); ?>

    </div>
</div>

<br />

<div class="row">
    <div class="col col-sm-3">
        <?php echo $this->Form->input('creditcard_month', array(
            'label' => 'Expiration Month',
            'class' => 'form-control',
            'options' => array(
                '01' => '01 - January',
                '02' => '02 - February',
                '03' => '03 - March',
                '04' => '04 - April',
                '05' => '05 - May',
                '06' => '06 - June',
                '07' => '07 - July',
                '08' => '08 - August',
                '09' => '09 - September',
                '10' => '10 - October',
                '11' => '11 - November',
                '12' => '12 - December'
            )
        )); ?>
    </div>
    <div class="col col-sm-3">
        <?php echo $this->Form->input('creditcard_year', array(
            'label' => 'Expiration Year',
            'class' => 'form-control',
            'options' => array_combine(range(date('y'), date('y') + 10), range(date('Y'), date('Y') + 10))
        ));?>
    </div>
</div>

<br />
<br />

<?php endif; ?>

<?php echo $this->Form->button('<i class="fa fa-check"></i> &nbsp; Place your order', array('class' => 'btn btn-sm btn-success', 'ecape' => false)); ?>

<?php echo $this->Form->end(); ?>

<br />
<br />

