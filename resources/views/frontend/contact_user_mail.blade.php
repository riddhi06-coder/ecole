<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
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
            <p>Hi <strong>{{ $data->name }}</strong>,</p>

            <p>We have received your enquiry and our team will get back to you very soon.</p>
            <br>
            <p><strong>Your Details:</strong></p>
            <p><strong>Email:</strong> {{ $data->email }}</p>
            <p><strong>Phone:</strong> {{ $data->phone }}</p>
            @if(!empty($data->enquiry_type))
                <p><strong>Enquiry Type:</strong> {{ ucfirst(str_replace('-', ' ', $data->enquiry_type)) }}</p>
            @endif


            <p style="margin-top: 20px;">We appreciate your interest!</p>
            <br>
            <p>Warm regards,<br>
            <strong>Ecole Mondiale World School Team</strong></p>
        </div>

        <div class="footer">
            © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
        </div>
    </div>
</body>
</html>
