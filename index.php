
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Whatsapp API Library Documentation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="Whatsapp API" />
    <meta property="og:description" content="Whatsapp API Library v6 APIGET" />
    <meta property="og:image" content="https://shop.arfi.tech/assets/shop.png" />

    <!-- Bootstrap 4.6 and Google Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            padding: 3rem;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #34495e;
        }

        p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }

        .btn {
            font-size: 1rem;
            padding: 0.8rem 1.5rem;
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .section-block {
            background-color: #ecf0f1;
            padding: 2.5rem;
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .code-block pre {
            background-color: #2d3436;
            color: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            overflow-x: auto;
            margin: 2rem 0;
            font-size: 1rem;
        }

        /* Table Styles */
        .table {
            background-color: #fff;
            color: #333;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 1.2rem;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #2980b9;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f4f6f9;
        }

        .table tbody tr:hover {
            background-color: #ecf0f1;
            cursor: pointer;
        }

        .uri {
            color: #fff;
        }

        .block-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 1.5rem;
        }

        /* Animation for smoother transitions */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

    </style>
</head>

<body>

    <div class="container fade-in">
        <h4>Whatsapp API Library v6 - APIGET</h4>
        <p>To use this library, visit the <a href="/device.php" target="_blank" class="btn btn-link">Scan QR</a> page.</p>
        <hr>

        <!--<div class="section-block">
            <h5 class="block-title">Send Whatsapp Message</h5>
            <p class="text-muted">This function allows you to send a message to a new or existing chat. Use this to send messages via WhatsApp API.</p>
            <code class="btn btn-dark">
                <span class="label label-primary" style="background-color: #2980b9;">POST</span>
                <span class="uri"></span>send
            </code>

            <div class="code-block">
                <pre class="language-php"><code class="language-php">
&lt;?php
$curl = curl_init();
$data = [
    'number' => '6281xxx',  // number sender
    'type' => 'chat',       // type delivery
    'message' => 'try message 1',  // message content
    'to' => '628552xxx'     // number receiver
];
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_URL, '<span class="uri"></span>send');
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($curl);
curl_close($curl);

echo "&lt;pre&gt;";
print_r($result);
?&gt;
                </code></pre>
            </div>-->

            <code class="btn-dark">
                <span class="label label-primary" style="background-color: #2980b9;">GET</span>
                <span class="uri"></span>send.php?number=9073466806&message=hi
            </code>
            <hr>

            <h6>Request Parameters:</h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">number</th>
                            <td>Yes</td>
                            <td>Receiver phone number. Example: 907346xxxx (without country code)</td>
                        </tr>
                        <tr>
                            <th scope="row">type</th>
                            <td>Yes</td>
                            <td>Type of message. E.g., 'chat'.</td>
                        </tr>
                        <tr>
                            <th scope="row">message</th>
                            <td>Yes</td>
                            <td>Text message. Max characters: 1000. UTF-8 or UTF-16 format.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const url = window.location.href;
        document.querySelectorAll('.uri').forEach(el => el.textContent = url);
    </script>

</body>

</html>
