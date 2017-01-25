<?php echo form_open(''); ?>

<?php echo anchor(site_url('backend/groups'), lang('back'), array('class' => 'btn btn-default btn-sm')); ?>
<br /><br />

<div class="form-group">
	<?php echo form_label(lang('group_name').' (*)'); ?>
	<?php echo form_input('group_name', set_value('group_name', $group->name), array('class' => 'form-control')); ?>
	<?php echo form_error('group_name', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('group_description').' (*)'); ?>
	<?php echo form_input('group_description', set_value('group_description', $group->description), array('class' => 'form-control')); ?>
	<?php echo form_error('group_description', '<p class="text-danger">', '</p>'); ?>
</div>

<?php echo form_hidden('group_id', set_value('group_id', $group->id)); ?>
<?php echo form_submit('submit', lang('update'), array('class' => 'btn btn-primary btn-sm')); ?>

<?php echo form_close(); ?>