<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Acknowledgment</title>

    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .header {
            background: #f2f5f8;
            text-align: center;
            padding: 25px 15px;
        }

        .header img {
            width: 110px;
            height: auto;
            margin-bottom: 10px;
        }

        .content {
            padding: 35px 32px;
        }

        h2 {
            font-size: 22px;
            color: #0e3b65;
            margin: 0 0 10px;
            font-weight: 600;
        }

        p {
            font-size: 15px;
            line-height: 1.7;
            margin: 10px 0;
        }

        .highlight {
            font-weight: 600;
            color: #0e3b65;
        }

        .footer {
            background-color: #f2f5f8;
            text-align: center;
            padding: 18px;
            font-size: 13px;
            color: #777;
        }

        .divider {
            border-top: 1px solid #e3e6ea;
            margin: 0;
        }

        .info-box {
            margin-top: 20px;
            background: #f9fafc;
            border: 1px solid #e3e6ea;
            border-radius: 8px;
            padding: 18px;
        }

        .info-box p {
            margin: 6px 0;
            font-size: 15px;
        }
    </style>
    
    <!-- Event snippet for Submit lead form conversion page -->
    <script>
      gtag('event', 'conversion', {
          'send_to': 'AW-17839211100/IrntCKXHw-EbENyEs7pC',
          'value': 1.0,
          'currency': 'INR'
      });
    </script>

</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="https://anvayafoundation.com/ecole-mondiale/frontend/assets/img/emws-logo.png" alt="Ecole Mondiale Logo">
    </div>

    <hr class="divider">

    <!-- Content -->
    <div class="content">

        <p>Dear <span class="highlight">{{ $name }}</span>,</p>

        <p>
            Thank you for your interest in joining 
            <strong>Ecole Mondiale World School</strong>. 
            Your application for the position of 
            <strong>{{ $position }}</strong> has been successfully submitted.
        </p>
<br>
        <p>
            Our recruitment team will carefully review your profile. 
            If your qualifications match our current requirements, 
            we will contact you for the next steps in the selection process.
        </p>

        <div class="info-box">
            <p><strong>Applicant Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Applied Position:</strong> {{ $position }}</p>
            <p><strong>Submission Date:</strong> {{ date('d M, Y') }}</p>
        </div>

        <p style="margin-top: 25px;">
            Warm regards,<br>
            <strong>HR Department</strong><br>
            Ecole Mondiale World School
        </p>
    </div>

    <hr class="divider">

    <!-- Footer -->
    <div class="footer">
        © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
    </div>

</div>

</body>
</html>
