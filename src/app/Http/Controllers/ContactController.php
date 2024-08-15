<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // フォームを表示するメソッド
    public function contact(Request $request)
    {
        // return view('contact');
        // セッションからデータを取得して修正フォームに表示
    $contact = $request->session()->get('contact', []);
    return view('contact', ['contact' => $contact]);
    }

    // 確認画面を表示するメソッド
    public function confirm(ContactRequest $request)
    {
    $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tell1', 'tell2', 'tell3', 'address', 'building', 'category_id', 'detail']);

    // 性別の値を表示用の文字列に変換
    $genderMap = [
        '1' => '男性',
        '2' => '女性',
        '3' => 'その他',
    ];
    $contact['gender'] = $genderMap[$contact['gender']] ?? '不明';

    // 内容の値を表示用の文字列に変換
    $category_idMap = [
        '1' => '商品のお届けについて',
        '2' => '商品の交換について',
        '3' => '商品トラブル',
        '4' => 'ショップへのお問い合わせ',
        '5' => 'その他',
    ];
    $contact['category_id'] = $category_idMap[$contact['category_id']] ?? '不明';

    // 電話番号の各部品を結合
    $fullTell = "{$contact['tell1']}-{$contact['tell2']}-{$contact['tell3']}";
    $contact['tell'] = $fullTell; // 修正箇所

    // セッションにデータを保存
    $request->session()->put('contact', $contact);

    // 確認画面にデータを渡す
    return view('confirm', ['contact' => $contact]);
    }


    public function edit(Request $request)
{
    // セッションからデータを取得して修正フォームに表示
    $contact = $request->session()->get('contact', []);
    return view('contact', ['contact' => $contact]);
}

    
    // フォームから送信されたデータを保存するメソッド
    public function store(ContactRequest $request)
    {
    $validated = $request->validated();

    // 電話番号の各部品を結合して `tell` を作成
    $fullTell = "{$validated['tell1']}-{$validated['tell2']}-{$validated['tell3']}";
    $validated['tell'] = $fullTell;
    
     // `gender` は既に数値として扱われているため、変換は不要
    $validated['gender'] = intval($validated['gender']);
    
    // データの保存
    Contact::create($validated);

    $request->session()->forget('contact');

    return view('thanks');
    }   

    public function destroy($id)
    {
        // 指定されたIDのデータを取得し、存在しない場合は404エラーを返す
        $contact = Contact::findOrFail($id);
        
        // データを削除
        $contact->delete();

        // 削除後、一覧ページにリダイレクト
        return redirect()->route('admin.index')->with('success', 'データが削除されました。');
    }
}



