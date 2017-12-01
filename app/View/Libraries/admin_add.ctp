<div class="libraries form">
<?php echo $this->Form->create('Library'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Library'); ?></legend>
	<?php
		echo $this->Form->input('source');
		echo $this->Form->input('name');
		echo $this->Form->input('parent');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('url');
		echo $this->Form->input('address_street');
		echo $this->Form->input('address_mailing');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Libraries'), array('action' => 'index')); ?></li>
	</ul>
</div>
