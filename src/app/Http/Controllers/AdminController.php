<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        
        $contacts = Contact::with('category')->paginate($perPage);

        return view('admin', [
            'contacts' => $contacts,
            'genderMap' => $this->genderMap,
        ]);
    }

    public function search(Request $request)
    {
        // 1ページに表示する件数を設定
        $perPage = 7;

        // Gender選択肢のマッピング（例）
        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
            // 必要に応じて他の性別も追加
        ];
        
        // 各リクエストパラメータを取得
        $searchInfo = $request->input('searchInfo');
        $gender = $request->input('gender');
        $query = $request->input('query');
        $dateSelect = $request->input('dateSelect');

        // 性別の値をマッピングして変換
        $genderValue = $genderMap[$gender] ?? null;

        $contacts = Contact::with('category')
            ->keywordSearch($searchInfo)
            ->genderSearch($genderValue) 
            ->categoryContentSearch($query) 
            ->dateSearch($dateSelect) 
            ->simplePaginate($perPage);

        return view('admin', [
            'contacts' => $contacts,
            'genderMap' => $this->genderMap,
        ]);
    }

    public function exportCsv()
    {
        // データを取得
        $contacts = Contact::with('category')->get(); // すべてのデータを取得
        
        // CSVヘッダーの作成
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        ];
        
        // CSV内容の作成
        $handle = fopen('php://output', 'w');

        // エラーチェック
        if ($handle === false) {
            return response()->json(['error' => 'Unable to open output stream.'], 500);
        }

        // ヘッダー行
        fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '電話番号', '住所', '建物名', 'お問い合わせ内容']);
        
        // データ行
        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $this->genderMap[$contact->gender] ?? '未設定',
                $contact->email,
                $contact->category->content,
                $contact->tell,
                $contact->address,
                $contact->building,
                $contact->detail
            ]);
        }
        
        fclose($handle);

        return Response::stream(
            function () {},
            200,
            $headers
        );
    }
}
