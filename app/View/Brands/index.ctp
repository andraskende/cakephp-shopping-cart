<h1>Brands</h1>

<?php $this->Html->addCrumb('Brands'); ?>

<br />

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Name</th>
    </tr>
    <?php foreach ($brands as $brand): ?>
    <tr>
        <td><?php echo $this->Html->link($brand['Brand']['name'], array('action' => 'view', 'slug' => $brand['Brand']['slug'])); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br />
<br />
