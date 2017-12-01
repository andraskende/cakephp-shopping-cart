<h2>Brand</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <td>Id</td>
        <td><?php echo h($brand['Brand']['id']); ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo h($brand['Brand']['name']); ?></td>
    </tr>
    <tr>
        <td>Slug</td>
        <td><?php echo h($brand['Brand']['slug']); ?></td>
    </tr>
    <tr>
        <td>Active</td>
        <td><?php echo h($brand['Brand']['active']); ?></td>
    </tr>
    <tr>
        <td>Created</td>
        <td><?php echo h($brand['Brand']['created']); ?></td>
    </tr>
    <tr>
        <td>Modified</td>
        <td><?php echo h($brand['Brand']['modified']); ?></td>
    </tr>
</table>

<br />
<br />

<h3>Actions</h3>

<?php echo $this->Html->link('Edit Brand', array('action' => 'edit', $brand['Brand']['id']), array('class' => 'btn btn-default')); ?> </li>

<br />
<br />

<?php echo $this->Form->postLink('Delete Brand', array('action' => 'delete', $brand['Brand']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $brand['Brand']['id'])); ?>

<br />
<br />
