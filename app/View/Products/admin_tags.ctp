<style>
.checkbox {
    display: inline-block;
    padding-top: 0;
    margin-top: 0;
    margin-bottom: 0;
    vertical-align: bottom;
}
</style>

<h2>Admin Edit Product Tag</h2>


<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <td valign="top">
            <?php echo $this->Html->Image('/images/small/' . $product['Product']['image'], array('alt' => $product['Product']['name'], 'class' => 'image')); ?>
        </td>
        <td valign="top">
            Name: <?php echo h($product['Product']['name']); ?>
            <br />
            <br />
            Tags: '<?php echo $product['Product']['tags']; ?>'
        </td>
    </tr>
</table>

<div class="row">
    <div class="col-xs-12">
        <?php echo $this->Form->create('Product'); ?>
        <?php echo $this->Form->input('id', array('value' => $product['Product']['id'])); ?>
        <br />
        <table class="table-striped table-bordered table-condensed table-hover">
            <tr>
                <td valign="top">
                <?php $rows = ceil(count($tags) / 8); ?>
                <?php $counter = 0; ?>
                <?php foreach ($tags as $k => $v) : ?>

                    <?php
                    echo $this->Form->input("Product.tags][]", array(
                        'type' => 'checkbox',
                        'hiddenField' => false,
                        'label' => $v,
                        'value' => $v,
                        'id' => $v,
                        'checked' => (in_array($v, $selectedTags)) ? 'checked' : false,
                    ));
                    ?>

                    <br />

                    <?php $counter++; ?>
                    <?php if($counter % $rows === 0 ) : ?>
                    </td><td valign="top">
                    <?php endif; ?>

                <?php endforeach; ?>
                </td>
            </tr>
        </table>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<br />
<br />

<?php echo $this->Html->link('Refresh Page', array('action' => 'tag', $product['Product']['id']), array('class' => 'btn btn-default')); ?>

&nbsp; &nbsp;

<?php echo $this->Html->link('Edit Product', array('action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-default')); ?>

&nbsp; &nbsp;

<?php echo $this->Html->link('Edit Tags', array('controller' => 'tags', 'action' => 'index'), array('class' => 'btn btn-default')); ?>

&nbsp; &nbsp;



<br />
<br />

<h3>Neighbors:</h3>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <td valign="top">
            <?php echo $this->Html->Image('/images/small/' . $neighbors['prev']['Product']['image'], array('alt' => $neighbors['prev']['Product']['name'], 'class' => 'image')); ?>
        </td>
        <td valign="top">
            Name: <?php echo h($neighbors['prev']['Product']['name']); ?><br />
            <br />
            Tags: '<?php echo $neighbors['prev']['Product']['tags']; ?>'
            <br />
            <br />
            <?php echo $this->Html->link('Edit Previous Tags', array('action' => 'tag', $neighbors['prev']['Product']['id']), array('class' => 'btn btn-default btn-sm')); ?>
        </td>
        <td valign="top">
        &nbsp; &nbsp;
        </td>
        <td valign="top">
            <?php echo $this->Html->Image('/images/small/' . $neighbors['next']['Product']['image'], array('alt' => $neighbors['prev']['Product']['name'], 'class' => 'image')); ?>
        </td>
        <td valign="top">
            Name: <?php echo h($neighbors['next']['Product']['name']); ?><br />
            <br />
            Tags: '<?php echo $neighbors['next']['Product']['tags']; ?>'
            <br />
            <br />
            <?php echo $this->Html->link('Edit Next Tags', array('action' => 'tag', $neighbors['next']['Product']['id']), array('class' => 'btn btn-default btn-sm')); ?>
        </td>
    </tr>
</table>

<br />
<br />

<h3>Add New Tag</h3>

<div class="row">
    <div class="col-xs-2">

        <?php echo $this->Form->create('Tag', array('url' => array('controller' => 'tags', 'action' => 'add'))); ?>
        <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>

    </div>
</div>


<br />
<br />