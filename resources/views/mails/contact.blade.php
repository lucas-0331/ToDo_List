<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family: sans-serif;">
    <h3 style="display: flex; justify-content: center;">
        {{ $data['subject'] }}
    </h3>
    <p>
        {{ $data['message'] }}
    </p>
</body>
</html>
