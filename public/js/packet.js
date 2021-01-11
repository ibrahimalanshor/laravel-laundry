$(function () {
	const table = $('table').DataTable({
		serverSide: true,
		processing: true,
		ajax: {
			url: ajaxUrl,
			type: 'post',
			data: {
				_token: csrf
			}
		},
		columns: [
			{
				data: 'DT_RowIndex',
				searchable: false
			},
			{ data: 'name' },
			{
				data: 'price',
				searchable: false
			},
			{
				data: 'time',
				searchable: false
			},
			{
				data: 'action',
				orderable: false,
				searchable: false
			},
		]
	})

	const reload = () => table.ajax.reload()

	const handleSuccess = msg => {
		$('#alert').html(`<div class="alert alert-success alert-dismissible">
			${msg}
			<button class="close" data-dismiss="alert">&times;</button>
		</div>`)

		reload()
	}

	const destroy = function () {
		if (confirm('Hapus pengguna ini?')) {
			const id = table.row($(this).parents('tr')).data().id
			const url = deleteUrl.replace(':id', id)

			$.ajax({
				url: url,
				type: 'post',
				data: {
					_token: csrf,
					_method: 'DELETE'
				},
				success: handleSuccess
			})
		}
	}

	$('tbody').on('click', 'button', destroy)
})