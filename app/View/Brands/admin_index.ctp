<h2>Brands</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('slug'); ?></th>
        <th><?php echo $this->Paginator->sort('active'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions">Actions</th>
    </tr>
    <?php foreach ($brands as $brand): ?>
        <tr>
            <td><?php echo h($brand['Brand']['id']); ?></td>
            <td><?php echo h($brand['Brand']['name']); ?></td>
            <td><?php echo h($brand['Brand']['slug']); ?></td>
            <td><?php echo $this->Html->link($this->Html->image('icon_' . $brand['Brand']['active'] . '.png'), array('controller' => 'brands', 'action' => 'switch', 'active', $brand['Brand']['id']), array('class' => 'status', 'escape' => false)); ?></td>
            <td><?php echo h($brand['Brand']['created']); ?></td>
            <td><?php echo h($brand['Brand']['modified']); ?></td>
            <td class="actions">
                <?php echo $this->Html->link('View', array('action' => 'view', $brand['Brand']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $brand['Brand']['id']), array('class' => 'btn btn-default btn-xs')); ?>
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

<?php echo $this->Html->link('New Brand', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />