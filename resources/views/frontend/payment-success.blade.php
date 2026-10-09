<!DOCTYPE html>
<html lang="en">

@include('components.frontend.head')

<!-- Google Ads conversion -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-17839211100/IrntCKXHw-EbENyEs7pC',
      'value': 1.0,
      'currency': 'INR'
  });
</script>

<body>

@include('components.frontend.header')

<div class="container py-5">
    <div class="text-center">
        <h2 class="text-success mb-3">Payment Successful!</h2>
        <p>Thank you for completing your payment. Your transaction details are below:</p>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Order ID</th>
                        <td>#{{ $responseArray['order_id'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tracking ID</th>
                        <td>{{ $responseArray['tracking_id'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>
                            <span class="badge bg-success">
                                {{ $responseArray['order_status'] ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td>{{ $responseArray['payment_mode'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Bank Reference No</th>
                        <td>{{ $responseArray['bank_ref_no'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>
                            ₹{{ $responseArray['amount'] ?? $responseArray['mer_amount'] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{ $responseArray['currency'] ?? 'INR' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>

@include('components.frontend.footer')
@include('components.frontend.main-js')

</body>
</html>
