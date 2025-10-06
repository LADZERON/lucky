<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Спеціальна сторінка</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .info-box { background: #e3f2fd; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .warning-box { background: #fff3cd; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .button-group { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
        button { padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: 500; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-info { background: #17a2b8; color: white; }
        button:hover { opacity: 0.9; }
        .result-box { background: #f8f9fa; padding: 15px; border-radius: 4px; margin-bottom: 20px; display: none; }
        .history-box { background: #f8f9fa; padding: 15px; border-radius: 4px; margin-bottom: 20px; display: none; }
        .history-item { padding: 10px; border-bottom: 1px solid #dee2e6; }
        .history-item:last-child { border-bottom: none; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ласкаво просимо!</h1>
        
        <div class="info-box">
            <h3>Інформація про користувача:</h3>
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Phone:</strong> {{ $user->phonenumber }}</p>
            <p><strong>Дата реєстрації:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
        </div>
        
        <div class="warning-box">
            <p><strong>Увага:</strong> Посилання закінчується {{ $accessLink->expires_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="button-group">
            <button class="btn-warning" onclick="regenerateLink()">Перегенерувати посилання</button>
            <button class="btn-danger" onclick="deactivateLink()">Деактивувати посилання</button>
            <button class="btn-success" onclick="playGame()">Imfeelinglucky</button>
            <button class="btn-info" onclick="getHistory()">History</button>
        </div>

        <div id="result" class="result-box">
            <h3>Результат гри:</h3>
            <p><strong>Випадкове число:</strong> <span id="random-number"></span></p>
            <p><strong>Результат:</strong> <span id="game-result"></span></p>
            <p><strong>Сума виграшу:</strong> <span id="win-amount"></span></p>
        </div>

        <div id="history" class="history-box">
            <h3>Історія ігор:</h3>
            <div id="history-content"></div>
        </div>
        
        <a href="{{ route('register') }}">
            <button class="btn-primary">Повернутися до реєстрації</button>
        </a>
    </div>

    <script>
        const token = '{{ $accessLink->token }}';

        function regenerateLink() {
            fetch(`/access/${token}/regenerate`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.new_link) {
                    alert('Нове посилання: ' + data.new_link);
                    window.location.href = data.new_link;
                }
            });
        }

        function deactivateLink() {
            if (confirm('Ви впевнені, що хочете деактивувати посилання?')) {
                fetch(`/access/${token}/deactivate`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.href = '/';
                });
            }
        }

        function playGame() {
            fetch(`/access/${token}/play`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('random-number').textContent = data.random_number;
                document.getElementById('game-result').textContent = data.result;
                document.getElementById('win-amount').textContent = data.win_amount;
                document.getElementById('result').style.display = 'block';
                document.getElementById('history').style.display = 'none';
            });
        }

        function getHistory() {
            fetch(`/access/${token}/history`)
            .then(response => response.json())
            .then(data => {
                const historyContent = document.getElementById('history-content');
                if (data.length === 0) {
                    historyContent.innerHTML = '<p>Історія порожня</p>';
                } else {
                    historyContent.innerHTML = data.map(item => `
                        <div class="history-item">
                            <strong>${item.created_at}</strong> - 
                            Число: ${item.random_number}, 
                            Результат: ${item.result}, 
                            Виграш: ${item.win_amount}
                        </div>
                    `).join('');
                }
                document.getElementById('history').style.display = 'block';
                document.getElementById('result').style.display = 'none';
            });
        }
    </script>
</body>
</html>
