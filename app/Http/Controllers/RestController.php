<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    //

    public function upsertItems(Request $req)
    {

        Item::updateOrCreate(
            ["id" => $req->id],
            [
                'user_id' => Auth::user()->user_id,
                'type' => $req->type,
                'create_dt' => $req->date,
                'category' => $req->category,
                'amount' => $req->amount,
                "content" => $req->content
            ]
        );

        $items = Item::orderBy("id", "asc")->get();

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

        $items = Item::orderBy("id", "asc")->get();

        return $items;
    }
}
