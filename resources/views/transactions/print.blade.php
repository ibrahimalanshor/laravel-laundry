<!DOCTYPE html>
<html>

<head>

  <title>Print</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

  <div class="row">
    <div class="col-sm-4">
      <ul class="list-unstyled">
        <li class="mb-1">Pelanggan</li> 
        <li><b>{{ $transaction->customer->name }}</b></li>
        <li>Alamat: {{ $transaction->customer->address }}</li>
        <li>Telepon: {{ $transaction->customer->phone }}</li>
      </ul>
    </div>
    <div class="col-sm-4">
      <ul class="list-unstyled">
        <li><b>Nota</b>: {{ $transaction->note }}</li>
        <li><b>Tanggal</b>: {{ $transaction->date }}</li>
        <li><b>Status Pembayaran</b>: {{ $transaction->paymentStatusText }}</li>
        <li><b>Status Pengerjaan</b>: {{ $transaction->workingStatusText }}</li>
      </ul>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Paket</th>
          <th>Harga</th>
          <th>Berat</th>
          <th>Subtotal</th>
          <th>Estimasi Selesai</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $transaction->packet->name }}</td>
          <td>{{ $transaction->packet->price }}</td>
          <td>{{ $transaction->weight }}</td>
          <td>{{ $transaction->weight * $transaction->packet->price }}</td>
          <td>{{ $transaction->finishDate }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="row justify-content-end">
    <div class="col-sm-4">
      <p class="lead">Pembayaran</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th>Diskon</th>
              <td>{{ $transaction->discount }}</td>
            </tr>
            <tr>
              <th>Tax</th>
              <td>{{ $transaction->tax }}</td>
            </tr>
            <tr>
              <th>Total</th>
              <td>{{ $transaction->totalFormatted }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    window.print()
    window.onafterprint = window.history.back()
  </script>

</body>

</html>
