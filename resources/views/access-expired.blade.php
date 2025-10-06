<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Посилання недоступне</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .container { max-width: 400px; margin: 0 auto; padding: 20px; }
        .error-box { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        button { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Доступ недоступний</h1>
        
        <div class="error-box">
            <p>{{ $message }}</p>
        </div>
        
        <p>Посилання може бути недійсним або термін його дії закінчився. Будь ласка, зареєструйтеся знову для отримання нового посилання.</p>
        
        <a href="{{ route('register') }}">
            <button>Перейти до реєстрації</button>
        </a>
    </div>
</body>
</html>