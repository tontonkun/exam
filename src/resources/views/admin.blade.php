<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    @if (Auth::check())
    <div class="header">
        <div class="headerTitle">FashionablyLate</div>
         <form class="form" action="/logout" method="post">
            @csrf
        <button class="logoutButton" type="submit">logout</button>
        </form>
    </div>
    <div class="main">
        <form class="adminForm" action="/search" method="get">
            <div class="titleArea">
                <div class="title">Admin</div>
            </div>
            <div class="itemArea1">
                <div class="inputArea">
                    <input type="text" name="searchInfo" placeholder="名前やメールアドレスを入力してください" value="{{ request()->get('searchInfo') }}" />
                </div>
                <div class="genderOption">
                    <select id="genderSelect" name="gender">
                        <option value="" disabled {{ request()->get('gender') ? '' : 'selected' }}>性別</option>
                        <option value="allGender" {{ request()->get('gender') == 'allGender' ? 'selected' : '' }}>全て</option>
                        <option value="male" {{ request()->get('gender') == 'male' ? 'selected' : '' }}>男性</option>
                        <option value="female" {{ request()->get('gender') == 'female' ? 'selected' : '' }}>女性</option>
                        <option value="otherGender" {{ request()->get('gender') == 'otherGender' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="queryOption">
                    <select id="querySelect" name="query">
    <option value="" disabled {{ request()->get('query') ? '' : 'selected' }}>お問い合わせの種類</option>
    <option value="delivery" {{ request()->get('query') == 'delivery' ? 'selected' : '' }}>商品のお届けについて</option>
    <option value="exchange" {{ request()->get('query') == 'exchange' ? 'selected' : '' }}>商品の交換について</option>
    <option value="trouble" {{ request()->get('query') == 'trouble' ? 'selected' : '' }}>商品トラブル</option>
    <option value="question" {{ request()->get('query') == 'question' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
    <option value="otherQuery" {{ request()->get('query') == 'otherQuery' ? 'selected' : '' }}>その他</option>
</select>

                </div>    
                <div class="dateOption">
                    <input type="date" name="dateSelect" value="{{ request()->get('dateSelect') }}">
                </div>
                <div class="searchButton">
                    <button class="searchButton-submit" type="submit">検索</button>
                </div>
                <div class="resetButton">
                    <a class="resetButton-submit" href="{{ url()->current() }}">リセット</a>
                </div> 
            </div>
            <div class="itemArea2">
                <div class="exportButton">
                    <a class="exportButton-submit" href="{{ route('export.csv') }}">エクスポート</a>
                </div>
                <!-- ページネーションリンクの追加 -->
                <div class="pagination">
                    {{ $contacts->links() }}
                </div>
            </div>

            <div class="tableArea">
                <table class=dataTable>
                    <tr class=tableTitle>
                        <th class=item_name>お名前</th>
                        <th class=item_gender>性別</th>
                        <th class=item_email>メールアドレス</th>
                        <th class=item_content>お問い合わせの種類</th>
                        <th class=item_detail></th>
                    </tr>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>
                            <span>{{ $contact->last_name }}</span>
                            <span>{{ $contact->first_name }}</span>
                        </td>
                        <td>{{ $genderMap[$contact->gender] ?? '未設定' }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td class="detailButton_area">
                            <div class="modal-open"><a href="#modal">詳細</a></div>

                            <div class="modal" id="modal">
                                <a href="#!" class="overlay"></a>
                                <div class="modal-wrapper">
                                <div class="modal-contents">
                                    <a href="#!" class="modal-close">✕</a>
                                    <div class="modal-content">
                                        <div class="modal-row">
                                            <div class="modalItem-title">お名前</div>
                                            <div class="modalItem-content">
                                                <span>{{ $contact->last_name }}</span>
                                                <span>{{ $contact->first_name }}</span>
                                            </div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">性別</div>
                                            <div class="modalItem-content">{{ $genderMap[$contact->gender] ?? '未設定' }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">メールアドレス</div>
                                            <div class="modalItem-content">{{ $contact->email }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">電話番号</div>
                                            <div class="modalItem-content">{{ $contact->tell }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">住所</div>
                                            <div class="modalItem-content">{{ $contact->address }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">建物名</div>
                                            <div class="modalItem-content">{{ $contact->building }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">お問い合わせの種類</div>
                                            <div class="modalItem-content">{{ $contact->category ->content }}</div>
                                        </div>
                                        <div class="modal-row">
                                            <div class="modalItem-title">お問い合わせ内容</div>
                                            <div class="modalItem-content">{{ $contact->detail }}</div>
                                        </div>
                                        <!-- <div class="delete-button">削除</div> -->
                                         <!-- 削除フォーム -->
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？')">削除</button>
                                            </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </form> 

    </div>
    @endif
</body>
</html>
