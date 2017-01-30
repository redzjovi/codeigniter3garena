<?php echo form_open('', array('class' => 'form-inline', 'method' => 'get')); ?>

<div class="form-group">
	<?php $data = array(
		'' => '- Select Menu -',
		'backend_top' => 'Backend Top',
		'backend_left' => 'Backend Left',
		'backend_right' => 'Backend Right',
		'backend_bottom' => 'Backend Bottom',
	); ?>
	<?php echo form_dropdown('code', $data, $code, array('class' => 'form-control')); ?>
</div>
<?php echo form_submit('', lang('update'), array('class' => 'btn btn-info btn-sm')); ?>

<?php echo form_close(); ?>

<br />
<?php if ($code) : ?>
	<?php if ($this->j_acl->has_privilege('backend_menu_create', NULL, FALSE) === TRUE)
		echo anchor('backend/menus/create?code='.$code, lang('create'), array('class' => 'btn btn-primary btn-sm'));
	?>

	<br /><br />

	<table class="table table-bordered table-hover table-striped" id="table" width="100%">
		<thead>
			<tr>
				<th><?php echo lang('no'); ?></th>
				<th><?php echo lang('text_language'); ?></th>
				<th><?php echo lang('text'); ?></th>
				<th><?php echo lang('url'); ?></th>
				<th><?php echo lang('url_external'); ?></th>
				<th><?php echo lang('parent'); ?></th>
				<th><?php echo lang('position'); ?></th>
				<th><?php echo lang('status'); ?></th>
				<th><?php echo lang('action'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach((array) $menus as $menu) : ?>
				<tr>
					<td></td>
					<td><?php echo $menu['text_language']; ?></td>
					<td><?php echo $menu['text']; ?></td>
					<td><?php echo $menu['url']; ?></td>
					<td><?php echo $menu['url_external']; ?></td>
					<td><?php echo $menu['parent_id']; ?></td>
					<td><?php echo $menu['position']; ?></td>
					<td><?php echo $status[$menu['status']]; ?></td>
					<td>
						<?php if ($this->j_acl->has_privilege('backend_menu_update', NULL, FALSE) == TRUE)
							echo anchor(site_url('backend/menus/update/'.$menu['id'].'?code='.$code), lang('update'), array('class' => 'btn btn-success btn-sm')).'&nbsp';

						if ($this->j_acl->has_privilege('backend_menu_delete', NULL, FALSE) == TRUE)
							echo anchor(site_url('backend/menus/delete/'.$menu['id'].'?code='.$code), lang('delete'), array('class' => 'btn btn-danger btn-sm'));
						?>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

	<script>
	$(function () {
		var t = $('#table').DataTable({
			colReorder: true,
			columns: [
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
				{ 'orderable': false },
			],
			paging: false,
			responsive: true,
		});
		t.on( 'order.dt search.dt', function () {
			t.column(0, {search:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	});
	</script>
<?php endif; ?>