<?php if ($this->j_acl->has_privilege('backend_group_create', NULL, FALSE) === TRUE)
	echo anchor(site_url('backend/groups/create'), lang('create'), array('class' => 'btn btn-primary btn-sm'));
?>
<br /><br />

<table class="table table-bordered table-hover table-striped" id="table" width="100%">
	<thead>
		<tr>
			<th><?php echo lang('no'); ?></th>
			<th><?php echo lang('group_name'); ?></th>
			<th><?php echo lang('group_description'); ?></th>
			<th><?php echo lang('group_privileges'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach((array) $groups as $group) : ?>
			<tr>
				<td></td>
				<td><?php echo $group->name; ?></td>
				<td><?php echo $group->description; ?></td>
				<td>
					<?php if ($this->j_acl->has_privilege('backend_group_privileges_update', NULL, FALSE) === TRUE)
						echo anchor(site_url('backend/group_privileges/update/'.$group->id), lang('manage'));
					?>
				</td>
				<td>
					<?php if ($this->j_acl->has_privilege('backend_group_update', NULL, FALSE) == TRUE)
						echo anchor(site_url('backend/groups/update/'.$group->id), lang('update'), array('class' => 'btn btn-success btn-sm')).'&nbsp';
					
					if ($this->j_acl->has_privilege('backend_group_update', NULL, FALSE) == TRUE)
					{
						if ( ! in_array($group->name, array('admin','members')))
							echo anchor(site_url('backend/groups/delete/'.$group->id), lang('delete'), array('class' => 'btn btn-danger btn-sm'));
					}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<script>
$(function () {
	var t = $('#table').DataTable({
		colReorder: true,
		columns: [
			{ 'orderable': false },
			null,
			null,
			{ 'orderable': false },
			{ 'orderable': false },
		],
		responsive: true,
	});
	t.on( 'order.dt search.dt', function () {
		t.column(0, {search:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();
});
</script>