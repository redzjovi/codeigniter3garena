<?php echo anchor(site_url('backend/groups/create'), lang('create'), array('class' => 'btn btn-primary btn-sm')); ?>
<br /><br />

<table class="display nowrap responsive table table-bordered table-hover table-striped" id="table" width="100%">
	<thead>
		<tr>
			<th><?php echo lang('no'); ?></th>
			<th><?php echo lang('group_name'); ?></th>
			<th><?php echo lang('group_description'); ?></th>
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
					<?php echo anchor(site_url('backend/groups/update/'.$group->id), lang('update'), array('class' => 'btn btn-success btn-sm')); ?>
					<?php if ( ! in_array($group->name, array('admin','members'))) : ?>
						<?php echo anchor(site_url('backend/groups/delete/'.$group->id), lang('delete'), array('class' => 'btn btn-danger btn-sm')); ?>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<script>
$(function () {
	var t = $('#table').DataTable({
		colReorder: true
	});
	t.on( 'order.dt search.dt', function () {
		t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();
});
</script>