<h2>Categories</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('parent_id'); ?></th>
        <th><?php echo $this->Paginator->sort('lft'); ?></th>
        <th><?php echo $this->Paginator->sort('rght'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('slug'); ?></th>
        <th><?php echo $this->Paginator->sort('description'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions">Actions</th>
    </tr>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?php echo h($category['Category']['id']); ?></td>
            <td>
                <?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
            </td>
            <td><?php echo h($category['Category']['lft']); ?></td>
            <td><?php echo h($category['Category']['rght']); ?></td>
            <td><?php echo h($category['Category']['name']); ?></td>
            <td><?php echo h($category['Category']['slug']); ?></td>
            <td><?php echo h($category['Category']['description']); ?></td>
            <td><?php echo h($category['Category']['created']); ?></td>
            <td><?php echo h($category['Category']['modified']); ?></td>
            <td class="actions">
                <?php echo $this->Html->link('View', array('action' => 'view', $category['Category']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id']), array('class' => 'btn btn-default btn-xs')); ?>
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

<br />

<?php echo $this->Html->link('New Category', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->Tree->generate($categoriestree, array('element' => 'categories/tree_item', 'class' => 'categorytree', 'id' => 'categorytree')); ?>

<br />
<br />
