<?php echo anchor(site_url('backend/users/create'), lang('create'), array('class' => 'btn btn-primary btn-sm')); ?>
<br /><br />

<table class="table table-bordered table-hover table-striped" id="table" width="100%">
	<thead>
		<tr>
			<th><?php echo lang('no'); ?></th>
			<th><?php echo lang('id'); ?></th>
			<th><?php echo lang('username'); ?></th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('email'); ?></th>
			<th><?php echo lang('last_login'); ?></th>
			<th><?php echo lang('groups'); ?></th>
			<th><?php echo lang('user_privileges'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach((array) $users as $user) : ?>
			<tr>
				<td></td>
				<td><?php echo $user->id; ?></td>
				<td><?php echo $user->username; ?></td>
				<td><?php echo $user->first_name.' '.$user->last_name; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo date('Y-m-d H:i:s', $user->last_login); ?></td>
				<td>
					<?php foreach ($user->groups as $group) : ?>
						<?php echo anchor(site_url('backend/groups/update/'.$group->id), $group->name); ?><br />
					<?php endforeach; ?>
				</td>
				<td><?php echo anchor(site_url('backend/user_privileges/update/'.$user->id), lang('manage')); ?></td>
				<td>
					<?php echo anchor(site_url('backend/users/update/'.$user->id), lang('update'), array('class' => 'btn btn-success btn-sm')); ?>
					<?php if ($user->id != 1) : ?>
						<?php echo anchor(site_url('backend/users/delete/'.$user->id), lang('delete'), array('class' => 'btn btn-danger btn-sm')); ?>
					<?php endif; ?>
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
            null,
            null,
			null,
			{ 'orderable': false },
			{ 'orderable': false },
			{ 'orderable': false },
        ],
		responsive: true,
	});
	t.on( 'order.dt search.dt', function () {
		t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();
});
</script>