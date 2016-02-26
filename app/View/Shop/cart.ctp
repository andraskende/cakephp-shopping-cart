<?php echo $this->set('title_for_layout', 'Shopping Cart'); ?>

<?php $this->Html->addCrumb('Shopping Cart'); ?>

<?php echo $this->Html->script(array('cart.js'), array('inline' => false)); ?>

<h1>Shopping Cart</h1>

<?php if(empty($shop['OrderItem'])) : ?>

Shopping Cart is empty

<?php else: ?>

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'cartupdate'))); ?>

<hr>

<div class="row">
    <div class="col col-sm-1">#</div>
    <div class="col col-sm-7">ITEM</div>
    <div class="col col-sm-1">PRICE</div>
    <div class="col col-sm-1">QUANTITY</div>
    <div class="col col-sm-1">SUBTOTAL</div>
    <div class="col col-sm-1">REMOVE</div>
</div>

<?php $tabindex = 1; ?>
<?php foreach ($shop['OrderItem'] as $key => $item): ?>

    <div class="row" id="row-<?php echo $key; ?>">
        <div class="col col-sm-1"><?php echo $this->Html->image('/images/small/' . $item['Product']['image'], array('class' => 'px60')); ?></div>
        <div class="col col-sm-7">
            <strong><?php echo $this->Html->link($item['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $item['Product']['slug'])); ?></strong>
            <?php
            $mods = 0;
            if(isset($item['Product']['productmod_name'])) :
            $mods = $item['Product']['productmod_id'];
            ?>
            <br />
            <small><?php echo $item['Product']['productmod_name']; ?></small>
            <?php endif; ?>
        </div>
        <div class="col col-sm-1" id="price-<?php echo $key; ?>"><?php echo $item['Product']['price']; ?></div>
        <div class="col col-sm-1"><?php echo $this->Form->input('quantity-' . $key, array('div' => false, 'class' => 'numeric form-control input-small', 'label' => false, 'size' => 2, 'maxlength' => 2, 'tabindex' => $tabindex++, 'data-id' => $item['Product']['id'], 'data-mods' => $mods, 'value' => $item['quantity'])); ?></div>
        <div class="col col-sm-1" id="subtotal_<?php echo $key; ?>"><?php echo $item['subtotal']; ?></div>
        <div class="col col-sm-1"><span class="remove" id="<?php echo $key; ?>"></span></div>
    </div>
<?php endforeach; ?>

<hr>

<div class="row">
    <div class="col col-sm-12">
        <div class="pull-right">
        <?php echo $this->Html->link('<i class="fa fa-ban"></i> &nbsp; Clear Shopping Cart', array('controller' => 'shop', 'action' => 'clear'), array('class' => 'btn btn-sm btn-danger', 'escape' => false)); ?>
        &nbsp; &nbsp;
        <?php echo $this->Form->button('<i class="fa fa-calculator"></i> &nbsp; Update', array('class' => 'btn btn-sm btn-default', 'escape' => false));?>
        <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col col-sm-12 pull-right tr">
        Subtotal: <span class="normal" id="subtotal">$<?php echo $shop['Order']['subtotal']; ?></span>
        <br />
        <br />
        Sales Tax: <span class="normal">N/A</span>
        <br />
        <br />
        Shipping: <span class="normal">N/A</span>
        <br />
        <br />
        Order Total: <span class="red" id="total">$<?php echo $shop['Order']['total']; ?></span>
        <br />
        <br />

        <?php echo $this->Html->link('<i class="fa fa-check"></i> &nbsp; Checkout', array('controller' => 'shop', 'action' => 'address'), array('class' => 'btn btn-sm btn-success', 'escape' => false)); ?>

        <br />
        <br />

        <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'step1'))); ?>
        <input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal' class="sbumit" />
        <?php echo $this->Form->end(); ?>

    </div>
</div>

<br />
<br />

<?php endif; ?>
