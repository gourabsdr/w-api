<!DOCTYPE html>
<html lang="en">
<head>
    <title>Whatsapp Device Input</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400&display=swap" rel="stylesheet">

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
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.75rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #34495e;
            font-size: 1.1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem 1rem;
            border: 1px solid #bdc3c7;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2980b9;
            box-shadow: 0 0 10px rgba(41, 128, 185, 0.2);
        }

        .small.text-danger {
            font-size: 0.9rem;
            color: #e74c3c;
        }

        .btn-primary {
            font-size: 1rem;
            padding: 0.8rem 2rem;
            background-color: #2980b9;
            border-color: #2980b9;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3498db;
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:focus {
            outline: none;
        }

        .text-center {
            font-size: 1.2rem;
            color: #7f8c8d;
        }

    </style>
</head>
<body>

    <div class="container">
        <h4>Enter Your WhatsApp Number</h4>
        <form id="whatsappForm">
            <div class="form-group">
                <label for="number">Input your WhatsApp number:</label>
                <p class="small text-danger">You can use the country code prefix. Example: 6281223xxxx</p>
                <input type="number" class="form-control" id="number" name="device" placeholder="Enter number" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p class="text-center">By submitting, you agree to receive messages on WhatsApp.</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#whatsappForm").submit(function (event) {
                event.preventDefault(); // Prevent default form submission
                
                var number = $("#number").val();
                if (!number) {
                    alert("Please enter a valid WhatsApp number.");
                    return;
                }

                var createUrl = "https://sms.apiget.in/create.php?session=" + number;
                var qrUrl = "https://sms.apiget.in/qr.php?session=" + number;

                // First, hit the create API
                $.get(createUrl, function (response) {
                    // Once the API is hit, redirect to the QR page
                    window.location.href = qrUrl;
                }).fail(function () {
                    alert("Failed to connect. Please try again.");
                });
            });
        });
    </script>

</body>
</html>
