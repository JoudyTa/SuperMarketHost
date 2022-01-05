<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_Comment;
use App\Models\Product;

class UserCommentController extends Controller
{
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
        $request->validate([
            'user_comment' => ['required', 'string', 'min:1', 'max:400']
        ]);
        $comment = User_Comment::find($id);

        $comment->update(['user_comment' => $request->user_comment]);

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_Comment $user_comment)
    {
        return User_Comment::destroy($user_comment);
    }
}