<!DOCTYPE html>
<html>

<head>

  <title>Laporan</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

  <h1 class="text-center mb-3">Laporan Transaksi</h1>

  <div class="table-responsive">
    <table class="table table-striped table-bordered" width="100%">
      <thead>
        <tr>
          <th>Nota</th>
          <th>Tanggal</th>
          <th>Customer</th>
          <th>Paket</th>
          <th>Berat</th>
          <th>Status Pembayaran</th>
          <th>Status Pengerjaan</th>
          <th>Total Bayar</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($transactions as $transaction)
          <tr>
            <td>{{ $transaction->note }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->customer->name }}</td>
            <td>{{ $transaction->packet->name }}</td>
            <td>{{ $transaction->weight }}</td>
            <td>{{ $transaction->paymentStatusText }}</td>
            <td>{{ $transaction->workingStatusText }}</td>
            <td>{{ $transaction->totalFormatted }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7" align="center">
              Kosong
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <script>
    window.print()
    window.onafterprint = window.history.back()
  </script>

</body>

</html>
