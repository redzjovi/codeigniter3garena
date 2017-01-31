<?php echo form_open(''); ?>

<?php echo anchor(site_url('backend/groups'), lang('back'), array('class' => 'btn btn-default btn-sm')); ?>

<table class="table table-bordered table-hover table-striped" id="table" width="100%">
	<thead>
		<tr>
			<th><?php echo lang('no'); ?></th>
			<th><?php echo lang('privilege_code'); ?></th>
			<th><?php echo lang('privilege_name'); ?></th>
			<th><?php echo lang('privilege_description'); ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ((array) $privileges->result() as $privilege) : ?>
			<tr>
				<td></td>
				<td><?php echo $privilege->privilege_code; ?></td>
				<td><?php echo $privilege->privilege_name; ?></td>
				<td><?php echo $privilege->privilege_description; ?></td>
				<td align="center">
					<?php echo form_checkbox('privilege_id[]', $privilege->id,
					 	(in_array($privilege->id, $group_privileges))
					) ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php echo form_hidden('id', set_value('id', $group->id)); ?>
<?php echo form_submit('submit', lang('update'), array('class' => 'btn btn-primary btn-sm')); ?>

<?php echo form_close(); ?>

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
		info: false,
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