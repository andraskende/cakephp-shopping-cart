<h2>Product</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <td>Id</td>
        <td><?php echo h($product['Product']['id']); ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo h($product['Product']['name']); ?></td>
    </tr>
    <tr>
        <td>Slug</td>
        <td><?php echo h($product['Product']['slug']); ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo h($product['Product']['description']); ?></td>
    </tr>
    <tr>
        <td>Image</td>
        <td><?php echo h($product['Product']['image']); ?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><?php echo h($product['Product']['price']); ?></td>
    </tr>
    <tr>
        <td>Weight</td>
        <td><?php echo h($product['Product']['weight']); ?></td>
    </tr>
    <tr>
        <td>Brand</td>
        <td><?php echo h($product['Brand']['name']); ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php echo h($product['Category']['name']); ?></td>
    </tr>
    <tr>
        <td>Tags</td>
        <td><?php echo h($product['Product']['tags']); ?></td>
    </tr>
    <tr>
        <td>Active</td>
        <td><?php echo $this->Html->link($this->Html->image('icon_' . $product['Product']['active'] . '.png'), array('controller' => 'products', 'action' => 'switch', 'active', $product['Product']['id']), array('class' => 'status', 'escape' => false)); ?></td>
    </tr>
    <tr>
        <td>Created</td>
        <td><?php echo h($product['Product']['created']); ?></td>
    </tr>
    <tr>
        <td>Modified</td>
        <td><?php echo h($product['Product']['modified']); ?></td>
    </tr>
</table>

<?php echo $this->Html->Image('/images/small/' . $product['Product']['image'], array('alt' => $product['Product']['name'], 'class' => 'image')); ?>

<br />
<br />

<?php echo $this->Html->Image('/images/large/' . $product['Product']['image'], array('alt' => $product['Product']['name'], 'class' => 'image')); ?>

<br />
<br />

<h3>Upload Image</h3>

<?php echo $this->Form->create('Product', array('type' => 'file')); ?>
<?php echo $this->Form->input('id', array('value' => $product['Product']['id'])); ?>
<?php echo $this->Form->input('slug', array('type' => 'hidden', 'value' => $product['Product']['slug'])); ?>

<div class="row">

    <div class="col-sm-4">
    <?php echo $this->Form->input('image', array('type' => 'file')); ?>
    </div>

</div>

<br />

<?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>

<br />
<br />

<br />
<br />


<h3>Actions</h3>

<?php echo $this->Html->link('Edit Product', array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-default')); ?>

&nbsp; &nbsp;

<?php echo $this->Html->link('Edit Product Tags', array('action' => 'tags', $product['Product']['id']), array('class' => 'btn btn-default')); ?>

&nbsp; &nbsp;

<?php echo $this->Form->postLink('Delete Product', array('action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>

<br />
<br />

