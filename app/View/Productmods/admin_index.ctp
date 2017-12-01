<h2>Productmods</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('product_id'); ?></th>
        <th><?php echo $this->Paginator->sort('sku'); ?></th>
        <th><?php echo $this->Paginator->sort('active'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('price'); ?></th>
        <th><?php echo $this->Paginator->sort('modified'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($productmods as $productmod): ?>
    <tr>
        <td><?php echo h($productmod['Productmod']['id']); ?></td>
        <td>
            <?php echo $this->Html->link($productmod['Product']['name'], array('controller' => 'products', 'action' => 'view', $productmod['Product']['id'])); ?>
        </td>
        <td><?php echo h($productmod['Productmod']['sku']); ?></td>
        <td><?php echo h($productmod['Productmod']['active']); ?></td>
        <td><?php echo h($productmod['Productmod']['name']); ?></td>
        <td><?php echo h($productmod['Productmod']['price']); ?></td>
        <td><?php echo h($productmod['Productmod']['modified']); ?></td>
        <td><?php echo h($productmod['Productmod']['created']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $productmod['Productmod']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $productmod['Productmod']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $productmod['Productmod']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $productmod['Productmod']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />
