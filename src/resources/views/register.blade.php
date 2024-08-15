<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録フォーム</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>

    <div class="header">
        <div class="headerTitle">FashionablyLate</div>
        <a class="loginButton" href="/login">login</a>
    </div>

    <div class="main">
        <form class="registerForm" action="/register" method="post">
        @csrf

        <div class="titleArea">
            <div class="title">Register</div>
        </div>

        <div class="contents">

            <div class="items">お名前</div>
                <div class="form_inputText">
                    <input type="text" name="name" placeholder="例:山田　太郎"/>
                </div>
                <div class="form__error">
                @error('name')
                        {{ $message }}
                @enderror
                </div>

            <div class="items">メールアドレス</div>
                <div class="form_inputText">
                    <input type="text" name="email" placeholder="例:test@example.com"/>
                </div>
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

            <div class="items">パスワード</div>
                <div class="form_inputText">
                    <input type="text" name="password" placeholder="例:coachtech1106"/>
                </div>
                <div class="form__error">
                @error('password')
                        {{ $message }}
                @enderror
                </div>

            <div class="registerButton">
                <button type="submit">登録</button>
            </div>      
        </div>
        </form>
    </div>
    
</body>
</html>