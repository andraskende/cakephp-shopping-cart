<?php
$this->Html->addCrumb('Categories', '/categories/');
foreach ($parents as $parent) {
    $this->Html->addCrumb($parent['Category']['name'], '/category/' . $parent['Category']['slug']);
}
?>

<h2><?php echo $category['Category']['name']; ?><small> Category</small></h1>

<?php if (!empty($products)): ?>

<?php echo $this->element('products'); ?>

<?php endif; ?>