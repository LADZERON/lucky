<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Реєстрація успішна</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .container { max-width: 400px; margin: 0 auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .link-box { background: #f8f9fa; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .link-box a { color: #007bff; word-break: break-all; }
        button { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Реєстрація успішна!</h1>
        
        <div class="success">
            <p>Ваше унікальне посилання для доступу до спеціальної сторінки:</p>
        </div>
        
        <div class="link-box">
            <a href="{{ $link }}">{{ $link }}</a>
        </div>
        
        <p><small>Посилання дійсне протягом 7 днів</small></p>
        
        <button onclick="copyToClipboard('{{ $link }}')">
            Скопіювати посилання
        </button>
    </div>
    
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Посилання скопійовано в буфер обміну!');
            });
        }
    </script>
</body>
</html>
