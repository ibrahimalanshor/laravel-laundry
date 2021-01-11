$(function () {
	const reset = () => $('.create')[0].reset()
	const grandtotal = () => {
		const subtotal = Number($('[name=subtotal]').val())
		const discount = $('[name=discount]').val()
		const taxVal = $('[name=tax]').val()

		const tax = taxVal / 100 * subtotal
		const total = Math.max(subtotal + tax - discount, 0)

		$('[name=total]').val(total)
	}
	const subtotal = weight => {
		const price = $('[name=price]').val()
		const subtotal = price * weight

		$('[name=subtotal]').val(subtotal)
	}
	const finish = time => {
		const date = new Date()
		date.setDate(date.getDate() + time)

		const finish = date.toISOString().slice(0, 10)

		$('[name=finish]').val(finish)
	}

	$('[name=customer_id]').select2({
		placeholder: 'Pelanggan',
		ajax: {
			url: customerSearch,
			type: 'post',
			data: params => ({
				_token: csrf,
				name: params.term
			}),
			processResults: res => ({
				results: res
			})
		},
		cache: true
	})
	$('[name=packet_id]').select2({
		placeholder: 'Paket',
		ajax: {
			url: packetSearch,
			type: 'post',
			data: params => ({
				_token: csrf,
				name: params.term
			}),
			processResults: res => ({
				results: res
			})
		},
		cache: true
	})

	$('[name=customer_id]').on('select2:select', e => {
		const { phone, address } = e.params.data

		$('[name=phone]').val(phone)
		$('[name=address]').val(address)
	})
	$('[name=packet_id]').on('select2:select', e => {
		const { price, time } = e.params.data
		const weight = $('[name=weight]').val()

		$('[name=price]').val(price)
		subtotal(weight)
		finish(time)
		grandtotal()
	})

	$('[name=weight]').on('keyup', function () {
		subtotal(this.value)
		grandtotal()
	})
	$('[name=discount]').on('keyup', grandtotal)
	$('[name=tax]').on('keyup', grandtotal)

	reset()
})