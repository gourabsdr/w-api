<?php
$session = $_REQUEST['session'] ?? '';

// If the request is made via AJAX, return JSON response
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:7000/get-qr?session=' . urlencode($session),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    header('Content-Type: application/json');
    echo $response;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .qr-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .qr-container img {
            border: 5px solid #007bff;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
        }
        .btn-refresh {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="qr-container">
    <h2 class="text-primary">Your QR Code</h2>
    <img id="qrImage" src="" alt="QR Code" class="img-fluid">
    <br>
    <button class="btn btn-primary btn-refresh" onclick="fetchQRCode()">Refresh QR Code</button>
    <a href="https://sms.apiget.in/" class="btn btn-primary btn-refresh">Go To Home</a>
    <p id="status" class="text-danger" style="display:none;">Failed to load QR code.</p>
</div>

<script>
    function fetchQRCode() {
        $.ajax({
            url: "?ajax=1&session=<?php echo urlencode($session); ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.qr) {
                    $("#qrImage").attr("src", data.qr).show();
                    $("#status").hide();
                } else {
                    $("#status").show();
                    $("#qrImage").hide();
                }
            },
            error: function() {
                $("#status").show();
                $("#qrImage").hide();
            }
        });
    }

    // Auto-refresh every 10 seconds
    setInterval(fetchQRCode, 5000);

    // Fetch QR Code on page load
    $(document).ready(fetchQRCode);
</script>

</body>
</html>
