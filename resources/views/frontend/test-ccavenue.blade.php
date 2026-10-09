<!DOCTYPE html>
<html>
<head>
    <title>CCAvenue Live Payment</title>
</head>
<body>

<h2>CCAvenue Live Payment</h2>

<form method="post"
      action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"
      id="ccavenue_redirect">

    <!-- Access code -->
    <input type="hidden" name="access_code" value="{{ $access_code }}">

    <!-- Encrypted request -->
    <input type="hidden" name="encRequest" value="{{ $encryptedData }}">

    <button type="submit">Pay Now</button>
</form>

<script>
    // Uncomment to auto-submit form
    // document.getElementById('ccavenue_redirect').submit();
</script>

</body>
</html>
