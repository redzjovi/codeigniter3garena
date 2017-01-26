<?php if ($this->Privileges_Model->has_privilege('backend_privilege_Create', NULL, FALSE) === TRUE)
	echo anchor(site_url('backend/privileges/create'), lang('create'), array('class' => 'btn btn-primary btn-sm'));
?>

<br /><br />

<table class="table table-bordered table-hover table-striped" id="table" width="100%">
	<thead>
		<tr>
			<th><?php echo lang('no'); ?></th>
			<th><?php echo lang('privilege_code'); ?></th>
			<th><?php echo lang('privilege_name'); ?></th>
			<th><?php echo lang('privilege_description'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach((array) $privileges->result() as $privilege) : ?>
			<tr>
				<td></td>
				<td><?php echo $privilege->privilege_code; ?></td>
				<td><?php echo $privilege->privilege_name; ?></td>
				<td><?php echo $privilege->privilege_description; ?></td>
				<td>
					<?php if ($this->Privileges_Model->has_privilege('backend_privilege_update', NULL, FALSE) === TRUE)
						echo anchor(site_url('backend/privileges/update/'.$privilege->id), lang('update'), array('class' => 'btn btn-success btn-sm')).'&nbsp';

					if ($this->Privileges_Model->has_privilege('backend_privilege_delete', NULL, FALSE) === TRUE)
						echo anchor(site_url('backend/privileges/delete/'.$privilege->id), lang('delete'), array('class' => 'btn btn-danger btn-sm'));
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
            null,
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