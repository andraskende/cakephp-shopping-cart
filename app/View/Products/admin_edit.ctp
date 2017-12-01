

<h2>Admin Edit Product</h2>

<br />

<div class="row">
    <div class="col-sm-8">

        <?php echo $this->Form->create('Product'); ?>
        <?php echo $this->Form->input('id'); ?>
        <br />
        <?php echo $this->Form->input('category_id', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('brand_id', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('slug', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('description', array('class' => 'form-control ckeditor')); ?>
        <br />
        <?php echo $this->Form->input('image', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('price', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('weight', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

        <br />
        <br />

    </div>
</div>

<script src="//cdn.ckeditor.com/4.5.7/full-all/ckeditor.js"></script>
<script>
    jQuery(document).ready(function($){
        var _content = $('#ProductDescription').get(0);
        var basePath = "<?php echo Router::url('/'); ?>";
        var editor = CKEDITOR.replace( _content,
        {
            height: 400,
            filebrowserBrowseUrl : basePath + 'kcfinder/browse.php?type=files',
            filebrowserImageBrowseUrl : basePath + 'kcfinder/browse.php?type=images',
            filebrowserFlashBrowseUrl : basePath + 'kcfinder/browse.php?type=flash',
            filebrowserUploadUrl : basePath + 'kcfinder/upload.php?type=files',
            filebrowserImageUploadUrl : basePath + 'kcfinder/upload.php?type=images',
            filebrowserFlashUploadUrl : basePath + 'kcfinder/upload.php?type=flash'
        });
    });
</script>

<br />
<br />

<h4>Product Modification:</h4>

<?php echo $this->Html->link('Add new Productmods', array('controller' => 'productmods', 'action' => 'add', $id), array('class' => 'btn btn-default')); ?>

<?php if(!empty($productmods)): ?>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>id</th>
        <th>product_id</th>
        <th>sku</th>
        <th>name</th>
        <th>change</th>
        <th>active</th>
        <th>created</th>
        <th>modified</th>
        <th>action</th>
    </tr>
    <?php foreach ($productmods as $productmod): ?>
    <tr>
        <td><?php echo h($productmod['Productmod']['id']); ?></td>
        <td><?php echo h($productmod['Productmod']['product_id']); ?></td>
        <td><?php echo h($productmod['Productmod']['sku']); ?></td>
        <td><?php echo h($productmod['Productmod']['name']); ?></td>
        <td><?php echo h($productmod['Productmod']['price']); ?></td>
        <td><?php echo h($productmod['Productmod']['active']); ?></td>
        <td><?php echo h($productmod['Productmod']['created']); ?></td>
        <td><?php echo h($productmod['Productmod']['modified']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('controller' => 'productmods', 'action' => 'view', $productmod['Productmod']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('controller' => 'productmods', 'action' => 'edit', $productmod['Productmod']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Form->postLink('Delete', array('controller' => 'productmods', 'action' => 'delete', $productmod['Productmod']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $productmod['Productmod']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<br />
<br />