<h2>Orders</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('first_name'); ?></th>
        <th><?php echo $this->Paginator->sort('last_name'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th><?php echo $this->Paginator->sort('phone'); ?></th>
        <th><?php echo $this->Paginator->sort('billing_city'); ?></th>
        <th><?php echo $this->Paginator->sort('billing_zip'); ?></th>
        <th><?php echo $this->Paginator->sort('billing_state'); ?></th>
        <th><?php echo $this->Paginator->sort('billing_country'); ?></th>
        <th><?php echo $this->Paginator->sort('shipping_city'); ?></th>
        <th><?php echo $this->Paginator->sort('shipping_zip'); ?></th>
        <th><?php echo $this->Paginator->sort('shipping_state'); ?></th>
        <th><?php echo $this->Paginator->sort('shipping_country'); ?></th>
        <th><?php echo $this->Paginator->sort('weight'); ?></th>
        <th><?php echo $this->Paginator->sort('subtotal'); ?></th>
        <th><?php echo $this->Paginator->sort('tax'); ?></th>
        <th><?php echo $this->Paginator->sort('shipping'); ?></th>
        <th><?php echo $this->Paginator->sort('total'); ?></th>
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?php echo h($order['Order']['first_name']); ?></td>
        <td><?php echo h($order['Order']['last_name']); ?></td>
        <td><?php echo h($order['Order']['email']); ?></td>
        <td><?php echo h($order['Order']['phone']); ?></td>
        <td><?php echo h($order['Order']['billing_city']); ?></td>
        <td><?php echo h($order['Order']['billing_zip']); ?></td>
        <td><?php echo h($order['Order']['billing_state']); ?></td>
        <td><?php echo h($order['Order']['billing_country']); ?></td>
        <td><?php echo h($order['Order']['shipping_city']); ?></td>
        <td><?php echo h($order['Order']['shipping_zip']); ?></td>
        <td><?php echo h($order['Order']['shipping_state']); ?></td>
        <td><?php echo h($order['Order']['shipping_country']); ?></td>
        <td><?php echo h($order['Order']['weight']); ?></td>
        <td><?php echo h($order['Order']['subtotal']); ?></td>
        <td><?php echo h($order['Order']['tax']); ?></td>
        <td><?php echo h($order['Order']['shipping']); ?></td>
        <td><?php echo h($order['Order']['total']); ?></td>
        <td><?php echo h($order['Order']['status']); ?></td>
        <td><?php echo h($order['Order']['created']); ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $order['Order']['id']), array('class' => 'btn btn-default btn-xs')); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />
