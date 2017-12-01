<h2>Database Backup</h2>

<?php echo $this->Html->link('Create new database backup', ['action' => 'backup'], ['class' => 'btn btn-primary']); ?>

<br />
<br />

<table class="table-striped table-bordered table-condensed table-hover">
    <?php foreach ($files as $file) : ?>
        <tr>
            <td><?php echo $this->Html->link($file, '/backups/' . $file); ?></td>
            <td><?php echo filesize(TMP . 'backups/' . $file); ?> KB</td>
            <td>
                <?php
                echo $this->Form->create(false, ['url' => ['action' => 'delete'], 'type' => 'GET']);
                echo $this->Form->hidden('file', ['value' => $file]);
                echo $this->Form->button('Delete', ['class' => 'btn btn-sm btn-danger']);
                echo $this->Form->end();
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>