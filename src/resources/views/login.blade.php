<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <div class="header">
        <div class="headerTitle">FashionablyLate</div>
        <a class="registerButton" href="/register">register</a>
    </div>
    <div class="main">
        <form class="loginForm" action="/login" method="post">
        @csrf
        <div class="titleArea">
            <div class="title">Login</div>
        </div>

        <div class="contents">
            <div class=itemArea>
                <div class="items">メールアドレス</div>
                    <div class="form_inputText">
                        <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>

                <div class="items">パスワード</div>
                    <div class="form_inputText">
                        <input type="text" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}"/>
                    </div>
                    <div class="form__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>


                <div class="loginButton">
                    <button type="submit">ログイン</button>
                </div>     
            </div> 
        </div>
    </div>
    
</body>
</html>