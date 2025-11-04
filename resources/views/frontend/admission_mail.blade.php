<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            text-align: center;
            padding: 20px 30px;
            background-color: #f2f5f8;
        }
        .header img {
            width: 140px;
        }
        .content {
            padding: 30px;
        }
        h2 {
            font-size: 20px;
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 25px;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
        }
        .highlight {
            color: #2a5d84;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            padding: 20px;
            background-color: #f2f5f8;
        }
        .divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('frontend/assets/img/emws-logo.png') }}" alt="Ecole Mondiale Logo">
        </div>

        <div class="divider"></div>

        <!-- Content -->
        <div class="content">
            <h2>Thank you for your {{ $subject }} !</h2>

            <p>Dear Mr/Mrs. <span class="highlight"> {{ $father_name }} & {{ $mother_name }}</span>,</p>

            <p>
                Thank you for your interest in <strong>Ecole Mondiale World School</strong>.
                We have received your {{ strtolower($subject) }} successfully.
            </p>
            <br><br>

            <p><strong>Student Name:</strong> {{ $student_name }}</p>
            <p><strong>Grade Applied For:</strong> {{ $grade }}</p>

            <p style="margin-top: 20px;">
                Our Admissions Team will review your details and get in touch with you shortly
                to guide you through the next steps.
            </p>

            <br><br>
            <p>Warm regards,<br>
            <strong>Admissions Team</strong><br>
            Ecole Mondiale World School</p>
        </div>

        <div class="divider"></div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
        </div>
    </div>
</body>
</html>
