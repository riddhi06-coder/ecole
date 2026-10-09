<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New {{ $subject }}</title>

<style>
body{
    font-family:"Helvetica Neue", Arial, sans-serif;
    background:#f9fafc;
    margin:0;
    padding:0;
    color:#333;
}

.container{
    max-width:600px;
    margin:40px auto;
    background:#ffffff;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    overflow:hidden;
}

.header{
    text-align:center;
    padding:20px;
    background:#f2f5f8;
}

.header img{
    width:140px;
}

.content{
    padding:30px;
}

h2{
    text-align:center;
    font-size:20px;
    margin-bottom:25px;
}

.details{
    background:#f8f9fb;
    padding:20px;
    border-radius:6px;
}

.details p{
    margin:8px 0;
    font-size:15px;
}

.label{
    font-weight:600;
    color:#2a5d84;
}

.footer{
    text-align:center;
    font-size:13px;
    color:#777;
    padding:20px;
    background:#f2f5f8;
}

.divider{
    height:1px;
    background:#e5e5e5;
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

        <h2>New {{ $subject }} Received</h2>

        <p>A new enquiry has been submitted on the website. Please find the details below.</p>

        <div class="details">

            <p><span class="label">Student Name:</span> {{ $student_name }}</p>

            <p><span class="label">Father Name:</span> {{ $father_name }}</p>

            <p><span class="label">Mother Name:</span> {{ $mother_name }}</p>

            <p><span class="label">Grade Applied For:</span> {{ $grade }}</p>

            <p><span class="label">Email:</span> {{ $f_email }}</p>

            <p><span class="label">Phone:</span> {{ $f_phone ?? '-' }}</p>

            <p><span class="label">Form Type:</span> {{ $subject }}</p>

        </div>

        <br>

        <p>Please log in to the admin panel to review the enquiry.</p>

    </div>

    <div class="divider"></div>

    <!-- Footer -->
    <div class="footer">
        © {{ date('Y') }} Ecole Mondiale World School. All rights reserved.
    </div>

</div>

</body>
</html>