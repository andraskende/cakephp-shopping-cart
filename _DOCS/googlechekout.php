<?php

$merchant = '123456';
$key = 'asdfghjkl';

$xml = '<checkout-shopping-cart xmlns="http://checkout.google.com/schema/2">
  <shopping-cart>
    <items>
      <item>
        <item-name>bike 1</item-name>
        <item-description>description 1</item-description>
        <unit-price currency="USD">19.95</unit-price>
        <quantity>3</quantity>
      </item>
    </items>
  </shopping-cart>
</checkout-shopping-cart>';

$cart = base64_encode($xml);

echo $cart . "\n\n<br /><br /><br />\n\n";

$signature = base64_encode(hash_hmac('sha1', $xml, $key, true));

echo $signature . "\n\n<br /><br /><br />\n\n";

?>

<form method="POST" action="https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/<?php echo $merchant; ?>" accept-charset="utf-8">

<input type="hidden" name="cart" value="<?php echo $cart; ?>">

<input type="hidden" name="signature" value="<?php echo $signature; ?>">

<input type="image" name="Google Checkout" alt="checkout" src="http://checkout.google.com/buttons/checkout.gif?merchant_id=<?php echo $merchant; ?>&w=160&h=43&style=white&variant=text&loc=en_US" height="43" width="160"/>

</form>

