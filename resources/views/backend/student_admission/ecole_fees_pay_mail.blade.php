<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Fee Payment</title>
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
        .pay-btn {
            display: inline-block;
            background-color: #01295E;
            color: #ffffff;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
        }
        .footer {
            background-color: #f2f5f8;
            text-align: center;
            font-size: 13px;
            padding: 20px;
            color: #777;
        }
        .note {
            background: #f7f9fc;
            border-left: 4px solid #01295E;
            padding: 12px;
            font-size: 14px;
            margin-top: 20px;
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
        <h2>Student Fee Payment</h2>

        <p>Dear Parent / Guardian,</p>

        <p>
            Please complete the school fee payment for the student mentioned below using the secure link provided.
        </p>

        <div class="divider"></div>

        <p><span class="label">Student Name:</span> {{ $student->student_name }}</p>
        <p><span class="label">Grade:</span> {{ $student->grade }}</p>
        

        @if(!empty($emiType) && $emiType !== 'FULL')
            <p><strong>Payment Type:</strong> {{ $emiType }}</p>
        @endif
        
        <p><strong>Amount to Pay:</strong> ₹{{ number_format($selectedAmount) }}</p>
   
        <div class="divider"></div>
        
        
        <p style="text-align:center;">
            {{-- Show Full Amount button only if selected amount equals full amount --}}
            @if($selectedAmount == $student->amount)
                <a href="{{ route('razorpay.checkout', ['reference' => $student->payment_reference_id, 'amount' => $student->amount]) }}"
                   class="pay-btn">
                    Pay Full Amount
                </a>
            @endif
        
            {{-- Show EMI button only if selected amount is less than full amount --}}
            @if($selectedAmount < $student->amount)
                <a href="{{ route('razorpay.checkout', ['reference' => $student->payment_reference_id, 'amount' => $selectedAmount]) }}"
                   class="pay-btn">
                    Pay  {{ $emiType }}
                </a>
            @endif
        </p>





        <div class="divider"></div>
        
        <p style="margin-top:25px;">
            Once the payment is successful, a confirmation receipt will be emailed to you.
        </p>

        <p>
            If you have already completed this payment, please ignore this email.
        </p>

        <p style="margin-top:25px;">
            Warm regards,<br>
            <strong>Accounts Department</strong><br>
            Ecole Mondiale World School
        </p>

    </div>

    <!-- Footer -->
    <div class="footer">
        © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.<br>
        This is a system-generated email. Please do not reply.
    </div>

</div>
</body>
</html>
