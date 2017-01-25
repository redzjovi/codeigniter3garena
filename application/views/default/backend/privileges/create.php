<?php echo form_open(''); ?>

<?php echo anchor(site_url('backend/privileges'), lang('back'), array('class' => 'btn btn-default btn-sm')); ?>
<br /><br />

<div class="form-group">
	<?php echo form_label(lang('privilege_code').' (*)'); ?>
	<?php echo form_input('privilege_code', set_value('privilege_code'), array('class' => 'form-control')); ?>
	<?php echo form_error('privilege_code', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('privilege_name').' (*)'); ?>
	<?php echo form_input('privilege_name', set_value('privilege_name'), array('class' => 'form-control')); ?>
	<?php echo form_error('privilege_name', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('privilege_description')); ?>
	<?php echo form_input('privilege_description', set_value('description'), array('class' => 'form-control')); ?>
</div>

<?php echo form_submit('submit', lang('create'), array('class' => 'btn btn-primary btn-sm')); ?>

<?php echo form_close(); ?>