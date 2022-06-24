<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
</head>
<body>
    <h3>Hai ricevuto un email da: {{ $lead->name }} {{ $lead->surname }}</h3>
    <h3>Email: {{ $lead->sender_mail }}</h3>
    <h3>Messaggio:</h3>
    <p>{{ $lead->content }}</p>
</body>
</html>