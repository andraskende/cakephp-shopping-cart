
<h2>Tags</h2>

<br />

<?php echo $this->Html->link('New Tag', array('action' => 'add'), array('class' => 'btn btn-default')); ?>

<br />
<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions">Actions</th>
    </tr>
    <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?php echo $tag['Tag']['id']; ?></td>
        <td><?php echo $tag['Tag']['name']; ?></td>
        <td><?php echo $tag['Tag']['created']; ?></td>
        <td><?php echo $tag['Tag']['modified']; ?></td>
        <td class="actions">
            <?php echo $this->Html->link('View', array('action' => 'view', $tag['Tag']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $tag['Tag']['id']), array('class' => 'btn btn-default btn-xs')); ?>
            <?php echo $this->Form->postLink('Delete', array('action' => 'delete', $tag['Tag']['id']), array('class' => 'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />

<?php echo $this->element('pagination-counter'); ?>

<?php echo $this->element('pagination'); ?>

<br />
<br />
