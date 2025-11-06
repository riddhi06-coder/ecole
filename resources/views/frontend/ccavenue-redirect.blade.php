<html>
<body>
    <form method="post" action="{{ $ccavenue_url }}">
        <input type="hidden" name="encRequest" value="{{ $encrypted_data }}">
        <input type="hidden" name="access_code" value="{{ $access_code }}">
    </form>

    <script>
        document.forms[0].submit();
    </script>

</body>
</html>
