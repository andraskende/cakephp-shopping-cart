<h2>Database Backup</h2>

<?php echo $this->Html->link('Create new database backup', array('action' => 'backup'), array('class' => 'btn btn-primary')); ?>

<br />
<br />

<table class="table-striped table-bordered table-condensed table-hover">
    <?php foreach ($files as $file) : ?>
        <tr>
            <td><?php echo $this->Html->link($file, '/backups/' . $file); ?></td>
            <td><?php echo filesize(WWW_ROOT . 'backups/' . $file); ?> KB</td>
            <td>
                <br />
                <?php
                echo $this->Form->create('mysqldump', array('action' => 'delete', 'type' => 'POST'));
                echo $this->Form->hidden('file', array('value' => $file));
                echo $this->Form->button('Delete', array('class' => 'btn btn-danger'));
                echo $this->Form->end();
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>