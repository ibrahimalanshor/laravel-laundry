$(function () {

	const table = $('table').DataTable({
		serverSide: true,
		processing: true,
		ajax: {
			url: ajaxUrl,
			type: 'post',
			data: d => {
				d._token = csrf
				d.from = $('[name=from]').val()
				d.till = $('[name=till]').val()
				d.payment_status = $('[name=payment_status]').val()
				d.working_status = $('[name=working_status]').val()
			}
		},
		columns: [
			{ data: 'note', },
			{
				data: 'date',
				searchable: false
			},
			{ data: 'customer.name', },
			{ data: 'packet.name', },
			{
				data: 'weight',
				searchable: false
			},
			{
				data: 'status',
				searchable: false
			},
			{
				data: 'total',
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
		$('.modal').modal('hide')

		reload()
	}

	const filter = function (e) {
		e.preventDefault()
		reload()
		$(this).parents('#filter').collapse('hide')
	}

	const payment = function (e) {
		e.preventDefault()

		const modal = $('.paymentModal')
		const { id, payment_status } = table.row($(this).parents('tr')).data()
		const url = paymentUrl.replace(':id', id)

		modal.find('form').attr('action', url)
		modal.find('[name=payment_status]').val(payment_status)

		modal.modal('show')
	}

	const working = function (e) {
		e.preventDefault()

		const modal = $('.workingModal')
		const { id, working_status } = table.row($(this).parents('tr')).data()
		const url = workingUrl.replace(':id', id)

		modal.find('form').attr('action', url)
		modal.find('[name=working_status]').val(working_status)

		modal.modal('show')
	}

	const update = function (e) {
		e.preventDefault()

		$.ajax({
			url: this.action,
			type: 'post',
			data: $(this).serialize(),
			success: handleSuccess
		})
	}

	const destroy = function (e) {
		e.preventDefault()

		if (confirm('Hapus transaksi ini?')) {
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

	const print = () => {
		const filter = $('#filter form').serialize()
		window.location.href = `${printUrl}?${filter}`
	}

	$('tbody').on('click', '.payment', payment)
	$('tbody').on('click', '.working', working)
	$('tbody').on('click', '.delete', destroy)
	$('.print').on('click', print)
	$('#filter form').submit(filter)
	$('.paymentModal form').submit(update)
	$('.workingModal form').submit(update)

	$('#filter form')[0].reset()
})