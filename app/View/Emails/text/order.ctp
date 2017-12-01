Shop Order:

First Name: <?php echo $shop['Order']['first_name'];?>

Last Name: <?php echo $shop['Order']['last_name'];?>

Email: <?php echo $shop['Order']['email'];?>

Phone: <?php echo $shop['Order']['phone'];?>


Billing Address: <?php echo $shop['Order']['billing_address'];?>

Billing Address 2: <?php echo $shop['Order']['billing_address2'];?>

Billing City: <?php echo $shop['Order']['billing_city'];?>

Billing State: <?php echo $shop['Order']['billing_state'];?>

Billing Zip: <?php echo $shop['Order']['billing_zip'];?>

Billing Country: <?php echo $shop['Order']['billing_country'];?>


Shipping Address: <?php echo $shop['Order']['shipping_address'];?>

Shipping Address 2: <?php echo $shop['Order']['shipping_address2'];?>

Shipping City: <?php echo $shop['Order']['shipping_city'];?>

Shipping State: <?php echo $shop['Order']['shipping_state'];?>

Shipping Zip: <?php echo $shop['Order']['shipping_zip'];?>

Shipping Country: <?php echo $shop['Order']['shipping_country'];?>



Description			Item Price			Quantity			Extended Price
<?php foreach ($shop['OrderItem'] as $orderitem): ?>
<?php echo $orderitem['Product']['name']; ?>			$<?php echo $orderitem['Product']['price']; ?>			<?php echo $orderitem['quantity']; ?>			$<?php echo $orderitem['subtotal']; ?>

<?php endforeach; ?>

Items:	<?php echo $shop['Order']['quantity'];?>

Total:	$<?php echo $shop['Order']['total'];?>


////////////////////////////////////////////////////////////

<?php print_r($shop); ?>

////////////////////////////////////////////////////////////

