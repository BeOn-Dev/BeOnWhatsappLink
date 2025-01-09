<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Input Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container a {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3cc012;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container a:hover {
            background-color: #4ee321;
        }
    </style>
</head>
<body>
<div class="form-container">
    <a href="{{$responseBody['data']['link']}}" target="_blank">Login With Whatsapp</a>
</div>
</body>
</html>
