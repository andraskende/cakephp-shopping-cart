<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=products-' . date('YmdHis') . '.csv');
header('Pragma: no-cache');
?>
<?php foreach ($products[0]['Product'] as $key => $value): ?>"<?php echo $key; ?>",<?php endforeach; ?>
<?php echo "\n"; ?>
<?php foreach ($products as $product): ?>
<?php foreach ($product['Product'] as $key => $value): ?>"<?php echo h($value); ?>",<?php endforeach; ?>
<?php echo "\n"; ?>
<?php endforeach; ?>