<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation – Ecole Mondiale</title>
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f9fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #f2f5f8;
            padding: 20px;
            text-align: center;
        }
        .header img {
            width: 160px;
        }
        .content {
            padding: 30px;
        }
        h2 {
            font-size: 20px;
            color: #1a1a1a;
            margin-bottom: 20px;
            text-align: center;
        }
        .label {
            font-weight: bold;
            color: #01295E;
        }
        p {
            font-size: 15px;
            margin: 10px 0;
            line-height: 1.6;
        }
        .divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 25px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #11317B;
            color: #fff;
        }
        .total-row td {
            font-weight: bold;
        }
        .btn-download {
            display: inline-block;
            background-color: #01295E;
            color: #fff;
            padding: 12px 25px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
            text-align: center;
        }
        .footer {
            background-color: #f2f5f8;
            text-align: center;
            font-size: 13px;
            padding: 20px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <img src="{{ asset('frontend/assets/img/emws-logo.png') }}" alt="Ecole Mondiale Logo">
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Payment Confirmation</h2>

            <p>Dear Parent / Guardian,</p>

            <p>
                We have successfully received the payment for the student mentioned below.
                Thank you for completing the payment.
            </p>

            <div class="divider"></div>

            <p><span class="label">Student Name:</span> {{ $payment->student_name }}</p>
            <p><span class="label">Student Grade:</span> {{ $payment->grade }}</p>
            
            @if(!empty($emiType) && $emiType !== 'FULL')
                <p><span class="label">EMI Type:</span> {{ $emiType }}</p>
            @endif
            
            @if($emiType === 'FULL')
                <p><span class="label">Payment Type:</span> Full Payment</p>
            @endif
            
            <p><span class="label">Invoice Number:</span> {{ $invoiceNumber }}</p>
            <p><span class="label">Payment Reference:</span> {{ $payment->payment_reference_id }}</p>
            <p><span class="label">Payment Date:</span> {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y H:i') }}</p>

            <div class="divider"></div>

            <h3 style="text-align:center;">Fee Details</h3>
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Base Amount</td>
                        <td>₹ {{ number_format($feeBreakup['base_amount'] ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Convenience Charges</td>
                        <td>₹ {{ number_format($feeBreakup['convenience_charges'] ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>GST on Charges</td>
                        <td>₹ {{ number_format($feeBreakup['gst_on_charges'] ?? 0, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td>Total Paid</td>
                        <td>₹ {{ number_format($feeBreakup['total_paid'] ?? 0, 2) }}</td>
                    </tr>


                </tbody>
            </table>

            <p style="text-align:center;">
                <a href="{{ url('invoices/Payment_Receipt_' . $invoiceNumber . '.pdf') }}" 
                   class="btn-download" target="_blank">
                    Download Invoice
                </a>
            </p>

            <p style="margin-top:30px;">
                If you have any questions regarding your payment, please contact us.
            </p>

            <p style="margin-top:25px;">
                Warm regards,<br>
                <strong>Accounts Department</strong><br>
                Ecole Mondiale World School
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} École Mondiale World School. All rights reserved.<br>
            This is a system-generated email. Please do not reply.
        </div>

    </div>
</body>
</html>
