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
    <div class="title">Contact</div>

    <div class="inputItems">
        <form class="form" action="confirm" method="POST">
            @csrf
            <div class="inputRow">
                <div class="itemTitle">お名前</div>
                <div class="inputArea">
                    <input class="input-name" type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name', $contact['first_name'] ?? '') }}" >
                    <input class="input-name" type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name', $contact['last_name'] ?? '') }}" >
                </div>
            </div>
            <div class="form__error">
                    @error('first_name')
                        {{ $message }}
                    @enderror
                    @error('last_name')
                        {{ $message }}
                    @enderror
            </div>

            <div class="inputRow">
                <div class="itemTitle">性別</div>
                <div class="inputArea">
                    <input class="input-gender" type="radio" id="male" name="gender" value="1" {{ (old('gender', $contact['gender'] ?? '') == '男性') ? 'checked' : '' }}>
                    <label for="male">男性</label><br>
                    
                    <input class="input-gender" type="radio" id="female" name="gender" value="2" {{ (old('gender', $contact['gender'] ?? '') == '女性') ? 'checked' : '' }} >
                    <label for="female">女性</label><br>
                    
                    <input class="input-gender" type="radio" id="otherGender" name="gender" value="3" {{ (old('gender', $contact['gender'] ?? '') == 'その他') ? 'checked' : '' }} >
                    <label for="otherGender">その他</label><br>
                </div>
            </div>
            <div class="form__error">
                    @error('gender')
                        {{ $message }}
                    @enderror
            </div>

            <div class="inputRow">
                <div class="itemTitle">メールアドレス</div>
                <div class="inputArea">
                    <input class="input-email" type="email" name="email" placeholder="例:test@example" value="{{ old('email', $contact['email'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
            </div>
            
            <div class="inputRow">
                <div class="itemTitle">電話番号</div>
                <div class="inputArea">
                    <input class="input-tel" type="tel" name="tell1" placeholder="080" value="{{ old('tell1', $contact['tell1'] ?? '') }}">
                    <div class="hyphen">-</div>
                    <input class="input-tel" type="tel" name="tell2" placeholder="1234" value="{{ old('tell2', $contact['tell2'] ?? '') }}">
                    <div class="hyphen">-</div>
                    <input class="input-tel" type="tel" name="tell3" placeholder="5678" value="{{ old('tell3', $contact['tell3'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                @error('phone_validation')
                    {{ $message }}
                @enderror
            </div>

            <div class="inputRow">
                <div class="itemTitle">住所</div>
                <div class="inputArea">
                    <input class="input-address" type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷１－２－３" value="{{ old('address', $contact['address'] ?? '') }}" >
                </div>
            </div>
            <div class="form__error">
                    @error('address')
                        {{ $message }}
                    @enderror
            </div>

            <div class="inputRow">
                <div class="itemTitle">建物名</div>
                <div class="inputArea">
                    <input class="input-address" type="text" name="building" placeholder="例:千駄ヶ谷マンション１０１" value="{{ old('building', $contact['building'] ?? '') }}">
                </div>
            </div>

            <div class="inputRow">
                <div class="itemTitle">お問い合わせの種類</div>
                <div class="inputArea">
                    <select class="option-query" id="querySelect" name="content" >
                        <option value="" disabled selected>選択してください</option>
                        <option value="delivery" {{ old('content', $contact['content'] ?? '') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="exchange" {{ old('content', $contact['content'] ?? '') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="trouble" {{ old('content', $contact['content'] ?? '') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="question" {{ old('content', $contact['content'] ?? '') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="otherQuery" {{ old('content', $contact['content'] ?? '') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
            </div>  
            <div class="form__error">
                    @error('content')
                        {{ $message }}
                    @enderror
            </div>

            <div class="inputRow">
                <div class="itemTitle">お問い合わせ内容</div>
                <textarea class="text-query" name="detail" placeholder="お問い合わせ内容をご記載ください" cols="50" rows="5" >{{ old('detail', $contact['detail'] ?? '') }}</textarea>
            </div>
            <div class="form__error">
                    @error('detail')
                        {{ $message }}
                    @enderror
            </div>


            <div class="buttonArea">
                <button class="confirmButton" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</body>
</html>
