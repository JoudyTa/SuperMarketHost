<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Response;
use App\Models\User_Comment;
use App\Models\Product;
use Laravelista\Comments\Comment;

class CommentController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $comments = $product->comments()->get();
        return response()->json($comments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'user_comment' => ['required', 'string', 'min:1', 'max:400']
        ]);
        $comment = $product->comments()->create([
            'user_comment' => $request->user_comment,
            'user_id' => auth()->id()
        ]);
        return response()->json($comment);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = User_Comment::find($id);
        $comment->update($request->all());
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User_Comment::destroy($id);
    }
}