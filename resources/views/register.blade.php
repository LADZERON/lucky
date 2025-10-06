<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Реєстрація</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .container { max-width: 400px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 500; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 14px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Реєстрація</h1>
        
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}"
                    required
                >
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="phonenumber">Phone Number</label>
                <input 
                    type="text" 
                    id="phonenumber" 
                    name="phonenumber" 
                    value="{{ old('phonenumber') }}"
                    placeholder="+1234567890"
                    required
                >
                @error('phonenumber')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
