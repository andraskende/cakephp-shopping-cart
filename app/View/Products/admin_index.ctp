<script>

$(document).ready(function() {

    $('.category').editable({
        type: 'select',
        name: 'category_id',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Category',
        source: <?php echo json_encode($categorieseditable); ?>,
        placement: 'right',
    });

    $('.brand').editable({
        type: 'select',
        name: 'brand_id',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Brand',
        source: <?php echo json_encode($brandseditable); ?>,
        placement: 'right',
    });

    $('.name').editable({
        type: 'text',
        name: 'name',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Name',
        placement: 'right',
    });

    $('.description').editable({
        type: 'textarea',
        name: 'description',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Description',
        placement: 'right',
    });

    $('.price').editable({
        type: 'text',
        name: 'price',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Price',
        placement: 'left',
    });

    $('.weight').editable({
        type: 'text',
        name: 'weight',
        url: '<?php echo $this->webroot; ?>admin/products/editable',
        title: 'Weight',
        placement: 'left',
    });


});
</script>
<h2>Products</h2>

<?php echo $this->Form->create('Product'); ?>
<?php echo $this->Form->hidden('search', ['value' => 1]); ?>

<div class="row">

    <div class="col-1">
        <?php echo $this->Form->input('active', array('label' => false, 'class' => 'form-control', 'empty' => 'All Status', 'options' => array(1 => 'Active', 0 => 'Not Active'), 'selected' => $all['active'])); ?>
    </div>

    <div class="col-1">
        <?php echo $this->Form->input('brand_id', array('label' => false, 'class' => 'form-control', 'empty' => 'Brand', 'selected' => $all['brand_id'])); ?>
    </div>

    <div class="col-1">
        <?php echo $this->Form->input('filter', array(
            'label' => false,
            'class' => 'form-control',
            'options' => [
                'name' => 'Name',
                'description' => 'Description',
                'price' => 'Price',
                'created' => 'Created',
            ],
            'selected' => $all['filter']
        )); ?>

    </div>

    <div class="col-2">
        <?php echo $this->Form->input('name', array('label' => false, 'id' => false, 'class' => 'form-control', 'value' => $all['name'])); ?>

    </div>

    <div class="col-4">
        <?php echo $this->Form->button('Search', array('class' => 'btn btn-default')); ?>
        &nbsp; &nbsp;
        <?php echo $this->Html->link('Reset Search', array('controller' => 'products', 'action' => 'reset', 'admin' => true), array('class' => 'btn btn-danger')); ?>

    </div>

    <?php echo $this->Form->end(); ?>

</div>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('image'); ?></th>
        <th><?php echo $this->Paginator->sort('category_id'); ?></th>
        <th><?php echo $this->Paginator->sort('brand_id'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('slug'); ?></th>
        <th><?php echo $this->Paginator->sort('description'); ?></th>
        <th><?php echo $this->Paginator->sort('image'); ?></th>
        <th><?php echo $this->Paginator->sort('price'); ?></th>
        <th><?php echo $this->Paginator->sort('weight'); ?></th>
        <th><?php echo $this->Paginator->sort('tags'); ?></th>
        <th><?php echo $this->Paginator->sort('views'); ?></th>
        <th><?php echo $this->Paginator->sort('active'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions">Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?php echo $this->Html->Image('/images/small/' . $product['Product']['image'], array('width' => 100, 'height' => 100, 'alt' => $product['Product']['image'], 'class' => 'image')); ?></td>
        <td><span class="category" data-value="<?php echo $product['Category']['id']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Category']['name']; ?></span></td>
        <td><span class="brand" data-value="<?php echo $product['Brand']['id']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Brand']['name']; ?></span></td>
        <td><span class="name" data-value="<?php echo $product['Product']['name']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['name']; ?></span></td>
        <td><?php echo h($product['Product']['slug']); ?></td>
        <td><span class="description" data-value="<?php echo $product['Product']['description']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['description']; ?></span></td>
        <td><?php echo h($product['Product']['image']); ?></td>
        <td><span class="price" data-value="<?php echo $product['Product']['price']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['price']; ?></span></td>
        <td><span class="weight" data-value="<?php echo $product['Product']['weight']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['weight']; ?></span></td>
        <td><span class="tags" data-value="<?php echo $product['Product']['tags']; ?>" data-pk="<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['tags']; ?></span></td>
        <td><?php echo h($product['Product']['views']); ?></td>
        <td><?php echo $this->Html->link($this->Html->image('icon_' . $product['Product']['active'] . '.png'), array('controller' => 'products', 'action' => 'switch', 'active', $product['Product']['id']), array('class' => 'status', 'escape' => false)); ?></td>
        <td><?php echo h($product['Product']['created']); ?></td>
        <td><?php echo h($product['Product']['modified']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $product['Product']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Tags', array('action' => 'tags', $product['Product']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-default btn-xs')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('New Product', ['action' => 'add'], ['class' => 'btn btn-default']); ?>

<br />
<br />
