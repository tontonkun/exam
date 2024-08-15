<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // 性別のマッピング
    protected $genderMap = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];


    public function admin()
{
    // 1ページに表示する件数を設定
    $perPage = 7;
    
    $contacts = Contact::with('category')->Paginate($perPage);

    return view('admin', [
        'contacts' => $contacts,
        'genderMap' => $this->genderMap,
    ]);
}

public function search(Request $request)
{
    // 1ページに表示する件数を設定
    $perPage = 7;
    
    $contacts = Contact::with('category')
        ->KeywordSearch($request->searchInfo)
        ->GenderSearch($request->gender)
        ->CategoryContentSearch($request->query)
        ->dateSearch($request->dateSelect)
        ->simplePaginate($perPage);

    return view('admin', [
        'contacts' => $contacts,
        'genderMap' => $this->genderMap,
    ]);
}
}