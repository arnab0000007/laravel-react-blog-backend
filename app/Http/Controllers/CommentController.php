<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;
class CommentController extends Controller
{
    function addComment(Request $req)
    {
        $rules = [
            'comment' => 'required|min:3',
            'post_id' => 'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
         return response()->json(["error"=>$validator->errors()]);
        }
        else{
            $comment = new Comment;
            $comment->post_id = $req->input('post_id');
            $comment->comment = $req->input('comment');
            $comment->user_id = $req->input('user_id');
            $comment->save();
            return response()->json(["result"=>'comment added successfully']);
        }
    }
    function comments($id){
     return $comments = Comment::with('user')->where('post_id','=',$id)->get();
    }
}
