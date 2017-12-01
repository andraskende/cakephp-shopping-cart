<div class="row">
    <?php foreach ($products as $product): ?>
    <div class="col-sm-3">
        <?php echo $this->Html->image('/images/small/' . $product['Product']['image'], array('url' => array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug']), 'alt' => $product['Product']['name'], 'width' => 150, 'height' => 150, 'class' => 'img-fluid image')); ?>
        <br />
        <?php echo $this->Html->link($product['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug'])); ?>
        <br />
        $<?php echo $product['Product']['price']; ?>
        <br />
        <br />
    </div>        
    <?php endforeach; ?>
</div>

<br />
<br />
