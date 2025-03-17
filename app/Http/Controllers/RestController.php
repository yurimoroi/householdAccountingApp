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

        $items = Item::select('items.id', 'items.type', 'items.create_dt', 'categories.name', 'items.category', 'items.amount', 'items.content')->join('categories', 'items.category', '=', 'categories.id')->where('items.user_id', $userId)->orderBy("items.id", "asc")->get();

        return $items;
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

        // カテゴリーを削除
        $category->delete();

        // 最新のカテゴリー一覧を取得（ログインユーザーのもの + 共通カテゴリ）
        $categories = Category::select('name', 'id', 'type')->whereNull('user_id')->orWhere('user_id', $userId)->orderBy("id", "asc")->get();


        // 最新のカテゴリー一覧を返却
        return $categories;
    }
}
