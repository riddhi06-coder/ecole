<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Link Sent - Admin Notification</title>
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
        .status-badge {
            display: inline-block;
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
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
        <h2>Fees Payment Link Sent</h2>

        <p style="text-align:center;">
            <span class="status-badge">✔ Mail Delivered to Parents</span>
        </p>

        <p>Dear Admin,</p>

        <p>
            A fees payment link has been successfully sent to the parents of the student mentioned below.
        </p>

        <div class="divider"></div>

        <p><span class="label">Student Name:</span> {{ $student->student_name }}</p>
        <p><span class="label">Grade:</span> {{ $student->grade }}</p>
        <p><span class="label">Payment Reference:</span> {{ $paymentRef }}</p>

        @if(!empty($emiType) && $emiType !== 'FULL')
            <p><span class="label">Payment Type:</span> {{ $emiType }}</p>
        @else
            <p><span class="label">Payment Type:</span> Full Payment</p>
        @endif

        <p><span class="label">Amount:</span> ₹{{ number_format($selectedAmount) }}</p>

        <div class="divider"></div>

        <p><span class="label">Payment Link Sent To:</span></p>
        @foreach($parentEmails as $email)
            <p style="margin:4px 0;">• {{ $email }}</p>
        @endforeach

        <div class="note">
            You will receive another notification once the payment is completed by the parent.
        </div>

        <p style="margin-top:25px;">
            Warm regards,<br>
            <strong>System Notification</strong><br>
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