<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #16a34a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border: 2px dashed #16a34a;
            margin: 20px 0;
            letter-spacing: 5px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>GymCenter Verification</h1>
        </div>
        <div class="content">
            <h2>New Registration Request</h2>
            <p>Someone is attempting to register on GymCenter. Please enter the following verification code to authorize the registration:</p>
            
            <div class="code">{{ $code }}</div>
            
            <p><strong>Details:</strong></p>
            <ul>
                <li>IP Address: {{ $ip }}</li>
                <li>Time: {{ $time }}</li>
            </ul>
            
            <p><strong>Note:</strong> This code will expire in 10 minutes. If you did not request this, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>This is an automated message from GymCenter. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
