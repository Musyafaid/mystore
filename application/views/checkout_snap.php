<html>
<head>
    <title>Checkout</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-DkqA13Oy_POq6pqe"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
    <form id="payment-form" method="post" action="<?=site_url()?>/C_home/landing/">
        <input type="hidden" name="result_type" id="result-type" value="">
        <input type="hidden" name="result_data" id="result-data" value="">
    </form>

    <script type="text/javascript">
        $(document).ready(function () {
            // Automatically invoke the payment process
            snap.pay('<?=$snapToken?>', {
                onSuccess: function(result){
                    $("#result-type").val('success');
                    $("#result-data").val(JSON.stringify(result));
                    $("#payment-form").submit();
                },
                onPending: function(result){
                    $("#result-type").val('pending');
                    $("#result-data").val(JSON.stringify(result));
                    $("#payment-form").submit();
                },
                onError: function(result){
                    $("#result-type").val('error');
                    $("#result-data").val(JSON.stringify(result));
                    $("#payment-form").submit();
                }
            });
        });
    </script>
</body>
</html>
