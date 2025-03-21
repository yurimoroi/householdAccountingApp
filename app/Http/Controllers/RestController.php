<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    //upsertメソッドは1つのクエリで複数のレコードを更新(update)または挿入(insert)する機能
    public function upsertItems(Request $req)
    {
        $userId = Auth::user()->user_id;

        // アイテムを登録または更新
        Item::updateOrCreate(
            ["id" => $req->id],
            [
                'user_id' => $userId,
                'type' => $req->type,
                'create_dt' => $req->date,
                'category' => $req->category,
                'amount' => $req->amount,
                "content" => $req->content
            ]
        );

        // `create_dt` の年月を取得（フォーマット：YYYY-MM）
        $targetMonth = date('Y-m', strtotime($req->date));

        // 差額の取得処理
        $budgetDifference = Item::where('items.user_id', $userId)
            ->where('items.type', 'expense')
            ->where('items.category', $req->category)
            ->whereRaw("DATE_FORMAT(items.create_dt, '%Y-%m') = ?", [$targetMonth]) // 年月が一致する
            ->join('budgets', function ($join) use ($userId) {
                $join->on('items.category', '=', 'budgets.category')
                    ->where('budgets.user_id', $userId);
            })
            ->selectRaw('(budgets.budget_amount - SUM(items.amount)) AS budget_difference')
            ->groupBy('budgets.budget_amount')
            ->first();

        // 予算オーバーの判定
        $message = null;
        if ($budgetDifference && $budgetDifference->budget_difference < 0) {
            $message = '予算金額が超えています。';
        }

        // 最新のアイテム一覧を取得
        $items = Item::select(
            'items.id',
            'items.type',
            'items.create_dt',
            'categories.name',
            'items.category',
            'items.amount',
            'items.content'
        )
            ->join('categories', 'items.category', '=', 'categories.id')
            ->where('items.user_id', $userId)
            ->orderBy("items.id", "asc")
            ->get();

        // JSONレスポンスを返す
        return response()->json([
            'message' => $message,
            'items' => $items
        ]);
    }

    public function deleteItems(Request $req)
    {
        if (gettype($req->id) == "string") {
            Item::where('id', $req->id)->delete();
        } else {
            foreach ($req->id as $id) {
                Item::where('id', $id)->delete();
            }
        }

        $userId = Auth::user()->user_id;

        $items = Item::select('items.id', 'items.type', 'items.create_dt', 'categories.name', 'items.category', 'items.amount', 'items.content')->join('categories', 'items.category', '=', 'categories.id')->where('items.user_id', $userId)->orderBy("items.id", "asc")->get();

        return $items;
    }

    public function upsertCategory(Request $req)
    {
        $userId = Auth::user()->user_id;

        Category::updateOrCreate(
            ["id" => $req->category, "user_id" => $userId],
            [
                'user_id' => Auth::user()->user_id,
                'type' => $req->type,
                'name' => $req->name
            ]
        );

        $categories = Category::select('name', 'id', 'type')->whereNull('user_id')->orWhere('user_id', $userId)->orderBy("id", "asc")->get();

        return $categories;
    }

    public function deleteCategory(Request $req)
    {

        // ログインユーザーのIDを取得
        $userId = Auth::user()->user_id;

        // 削除対象のカテゴリーを取得（ログインユーザーが作成したものに限定）
        $category = Category::where('id', $req->category)->where('user_id', $userId)->first();

        // カテゴリーが見つからない（共通カテゴリなど）場合はメッセージを返却
        if (!$category) {
            return response()->json([
                'message' => '共通のカテゴリーは削除できません。'
            ]);
        }

        // Itemsテーブルで該当カテゴリーが使用されている件数を取得
        $itemCount = Item::where('category', $req->category)->count();

        // もし1件以上存在する場合は削除不可
        if ($itemCount > 0) {
            return response()->json([
                'message' => '使用しているカテゴリーは削除できません。'
            ]);
        }

        // カテゴリーを削除
        $category->delete();

        // 最新のカテゴリー一覧を取得（ログインユーザーのもの + 共通カテゴリ）
        $categories = Category::select('name', 'id', 'type')->whereNull('user_id')->orWhere('user_id', $userId)->orderBy("id", "asc")->get();


        // 最新のカテゴリー一覧を返却
        return $categories;
    }
}
