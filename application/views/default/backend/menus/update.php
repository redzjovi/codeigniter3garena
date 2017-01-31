<?php echo form_open('backend/menus/update?code='.$code); ?>

<?php echo anchor(site_url('backend/menus?code='.$code), lang('back'), array('class' => 'btn btn-default btn-sm')); ?>
<br /><br />

<div class="form-group">
	<?php echo form_label(lang('code').' (*)'); ?>
	<?php echo form_input('code', $code, array('class' => 'form-control', 'readonly' => 'readonly')); ?>
	<?php echo form_error('code', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('icon')); ?>
	<?php echo form_input('icon', set_value('icon', $menu['icon']), array('class' => 'form-control')); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('text')); ?>
	<?php echo form_input('text', set_value('text', $menu['text']), array('class' => 'form-control')); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('url')); ?>
	<?php echo form_input('url', set_value('url', $menu['url']), array('class' => 'form-control')); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('url_external')); ?>
	<?php echo form_input('url_external', set_value('url_external', $menu['url_external']), array('class' => 'form-control')); ?>
</div>
<div class="form-group">
	<?php
	$data = build_tree($menus);
	$data = print_tree($data);
	$data = array('' => '- '.sprintf(lang('select_with_param'), lang('parent')).' -') + $data;
	?>
	<?php echo form_label(lang('parent').' (*)'); ?>
	<?php echo form_dropdown('parent_id', $data, set_value('parent_id', $menu['parent_id']), array('class' => 'form-control')); ?>
	<?php echo form_error('parent_id', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php
	$data = array_column($menus, 'text', 'position');
	foreach ((array) $data as $key => $value) :
		if ($key == $menu['position'])
			$data[$key] = $value;
		else
			$data[$key] = sprintf(lang('after_with_param'), $value);
	endforeach;
	$data = array('0' => lang('first')) + $data;
	$position = array_search($menu['position'], array_keys($data));
	$data = array_values($data);
	?>

	<?php echo form_label(lang('position').' (*)'); ?>
	<select class="form-control" name="position">
		<?php
		foreach ((array) $data as $key => $value) :
			echo '<option '.set_select('position', $key, ($key == $position ? TRUE : FALSE));

			if ($key + 1 == $position)
				echo 'disabled';

			echo ' value="'.$key.'">';

			echo $value;
			echo '</option>';
		endforeach;
		?>
	</select>
	<?php echo form_error('status', '<p class="text-danger">', '</p>'); ?>
</div>
<div class="form-group">
	<?php echo form_label(lang('status').' (*)'); ?>
	<?php echo form_dropdown('status', $status, set_value('status', $menu['status']), array('class' => 'form-control')); ?>
	<?php echo form_error('status', '<p class="text-danger">', '</p>'); ?>
</div>

<?php echo form_hidden('id', $menu['id']); ?>
<?php echo form_submit('submit', lang('update'), array('class' => 'btn btn-primary btn-sm')); ?>

<?php echo form_close(); ?>