<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Teaching Job Application</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #eef1f5;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            color: #2c2c2c;
        }

        .email-wrapper {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        /* Header */
        .email-header {
            background: #f3f6fa;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid #e4e7ec;
        }

        .email-header img {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
        }

        .email-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #0d3863;
            letter-spacing: 0.4px;
        }

        /* Body */
        .email-content {
            padding: 30px 35px;
        }

        .email-content p {
            font-size: 15px;
            line-height: 1.7;
            margin: 12px 0;
        }

        .info-section {
            background: #f8fafc;
            border: 1px solid #e6e9ef;
            border-radius: 10px;
            padding: 18px 20px;
            margin-top: 18px;
        }

        .info-section p {
            margin: 6px 0;
            font-size: 15px;
        }

        .info-section strong {
            display: inline-block;
            width: 160px;
            color: #0d3863;
        }

        /* Footer */
        .email-footer {
            background: #f3f6fa;
            padding: 18px;
            text-align: center;
            border-top: 1px solid #e4e7ec;
            font-size: 13px;
            color: #7a7a7a;
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <img src="https://anvayafoundation.com/ecole-mondiale/frontend/assets/img/emws-logo.png" alt="Ecole Mondiale World School">
        </div>

        <!-- Body -->
        <div class="email-content">

            <p>Dear HR Team,</p>

            <p>
                A new teaching job application has been submitted via the official Ecole Mondiale website.
                Please find the applicant details below:
            </p>

            <div class="info-section">
                <p><strong>Full Name:</strong> {{ $name }}</p>
                <p><strong>Email Address:</strong> {{ $email }}</p>
                <p><strong>Position Applied:</strong> {{ $position }}</p>
            </div>

            <p>
                Kindly review the submission at your earliest convenience.  
                For any additional information, please contact the website admin team.
            </p>

            <p>
                Best Regards, <br>
                <strong>Ecole Mondiale Website Notification System</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
        </div>

    </div>

</body>
</html>
