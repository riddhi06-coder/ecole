<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GrayQuest Portal – Start Process</title>
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
            margin: 20px 0;
        }
        .cta {
            text-align: center;
            margin: 30px 0;
        }
        .cta a {
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 22px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            display: inline-block;
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

        <div class="content">
            <h2>GrayQuest Portal – Start Process</h2><br>

            <p>Dear Parent,</p>

            <p>Your GrayQuest fee payment details for <strong>{{ $student_name }}</strong> are ready. Please find the details below:</p><br><br>

            <p><span class="label">GR No:</span> {{ $gr_no ?? 'N/A' }}</p>
            <p><span class="label">GrayQuest Student ID:</span> {{ $gq_student_id }}</p>
            <p><span class="label">Application ID:</span> {{ $gq_application_id }}</p>
            <p><span class="label">Reference ID:</span> {{ $gq_reference_id }}</p>
            <p><span class="label">Amount Payable:</span> ₹{{ number_format($amount) }}</p>

            <div class="divider"></div>

            <p style="text-align:center;">
                Click the button below to proceed with the GrayQuest process.
            </p>

            <div class="cta">
                <a href="{{ $payment_url ?? '#' }}">
                    Start Process
                </a>
            </div>

            <p style="font-size:14px;color:#666;margin-left:30px;">
                If you have any questions, please contact the school administration.<br><br><hr>
                
                <p>Warm regards,<br>
                <strong>Ecole Mondiale World School Team</strong></p>
            
            </p>
        </div>

        <div class="footer">
            © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
        </div>

    </div>
</body>
</html>
