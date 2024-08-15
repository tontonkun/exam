<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
    <div class="header">
        <div class="headerTitle">FashionablyLate</div>
    </div>
    <div class="title">Confirm</div>

    <div class="format">
        <div class="formatRow">
            <div class="itemTitle">お名前</div>
            <div class="content">
                <div class="displayValue">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">性別</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['gender'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">メールアドレス</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['email'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">電話番号</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['tell'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">住所</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['address'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">建物名</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['building'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">お問い合わせの種類</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['content'] }}
                </div>
            </div>
        </div>

        <div class="formatRow">
            <div class="itemTitle">お問い合わせ内容</div>
            <div class="content">
                <div class="displayValue">
                    {{ $contact['detail'] }}
                </div>
            </div>
        </div>
    </div>


    <div class="buttonArea">
        <form action="/z/contacts" method="POST">
            @csrf
            <input hidden type="text" name="first_name" value="{{ old('first_name', $contact['first_name'] ?? '') }}" >
            <input hidden type="text" name="last_name" value="{{ old('last_name', $contact['last_name'] ?? '') }}" >
            <button class="sendButton" type="submit">送信</button>
        </form>

        <form action="/z" method="GET">
            <button class="editButton" type="submit">修正する</button>
        </form>
    </div>


</body>
