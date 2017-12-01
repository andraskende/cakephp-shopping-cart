<div class="libraries index">
	<h2><?php echo __('Libraries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('source'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('parent'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('address_street'); ?></th>
			<th><?php echo $this->Paginator->sort('address_mailing'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($libraries as $library): ?>
	<tr>
		<td><?php echo h($library['Library']['id']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['source']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['name']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['parent']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['phone']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['email']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['url']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['address_street']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['address_mailing']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['note']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['created']); ?>&nbsp;</td>
		<td><?php echo h($library['Library']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $library['Library']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $library['Library']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $library['Library']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $library['Library']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Library'), array('action' => 'add')); ?></li>
	</ul>
</div>
