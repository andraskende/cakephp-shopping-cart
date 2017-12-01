<div class="libraries view">
<h2><?php echo __('Library'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($library['Library']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($library['Library']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($library['Library']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent'); ?></dt>
		<dd>
			<?php echo h($library['Library']['parent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($library['Library']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($library['Library']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($library['Library']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Street'); ?></dt>
		<dd>
			<?php echo h($library['Library']['address_street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Mailing'); ?></dt>
		<dd>
			<?php echo h($library['Library']['address_mailing']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($library['Library']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($library['Library']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($library['Library']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Library'), array('action' => 'edit', $library['Library']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Library'), array('action' => 'delete', $library['Library']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $library['Library']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Libraries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Library'), array('action' => 'add')); ?> </li>
	</ul>
</div>
