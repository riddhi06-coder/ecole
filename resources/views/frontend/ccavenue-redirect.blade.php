<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to CCAvenue...</title>
</head>
<body>
    <p>Redirecting to payment gateway, please wait...</p>

    <form id="ccavenueForm" method="post" action="{{ $ccavenue_url }}">
        <input type="hidden" name="encRequest" value="{{ $encrypted_data }}">
        <input type="hidden" name="access_code" value="{{ $access_code }}">
    </form>

    <script type="text/javascript">
        document.getElementById('ccavenueForm').submit();
    </script>
</body>
</html>
