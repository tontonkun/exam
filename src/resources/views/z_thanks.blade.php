<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
    <div class="header">
        <div class="headerTitle">FashionablyLate</div>
    </div>
    <div class="title">Thanks</div>

    <div class="inputItems">
        <form class="form" action="contacts/confirm" method="POST">
            <div class="inputRow">
                私は<div class="displayValue">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</div>です。。。
            </div>
        </form>
    </div>
</body>
</html>
