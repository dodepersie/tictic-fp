<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Registration Approved</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333333;
            font-weight: 600;
        }

        p {
            color: #666666;
            line-height: 1.6;
            font-weight: 400;
        }

        .password {
            font-size: 18px;
            font-weight: 600;
            color: #d9534f;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Hello, {{ $name }}!</h1>
        <p>Congratulations! Your Merchant Registration was approved and your password is:</p>
        <p class="password">{{ $password }}</p>
        <p>Now you can change it on the Dashboard!</p>
        <div class="footer">
            <p>Best Regards,</p>
            <p>TicTic.ID Team</p>
        </div>
    </div>
</body>

</html>
