<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Jn2gkFYwT_T9whBN"></script> <!-- Replace with your client key -->
</head>
<body>
    <h1>Payment Page</h1>
    
    <button id="pay-button">Pay Now</button>
    
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // Call your backend to create Snap token
            fetch('C_checkout/token') // Adjust the URL to your controller
                .then(response => response.json())
                .then(data => {
                    // Create Snap payment
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            /* You may add your own success handler here */
                            console.log('Payment Success:', result);
                        },
                        onPending: function(result) {
                            /* You may add your own pending handler here */
                            console.log('Payment Pending:', result);
                        },
                        onError: function(result) {
                            /* You may add your own error handler here */
                            console.log('Payment Error:', result);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching Snap token:', error);
                });
        };
    </script>
</body>
</html>
