<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;
class PostController extends Controller
{
    function addPost(Request $req)
    {
        $rules = [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'user_id' => 'required',

        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
         return response()->json(["error"=>$validator->errors()]);
        }
        else{
            $post = new Post;
            $post->user_id = $req->input('user_id');
            $post->title = $req->input('title');
            $post->description = $req->input('description');
            $post->save();
            return $post;
        }
    }
    function usersPost($id){
        return $posts = Post::with('user')->where('user_id','=',$id)->get();
       }

    function allPost(Request $req){
    return Post::with('user')->get();
    }
    function deletePost($id){

        $result = Post::where('id',$id)->delete();
        if($result){
            return response()->json(["result"=>"Post Deleted SuccessFully"]);
        }else{
            return response()->json(["error"=>"something went wrong"]);
        }
       
    }
    function singlePost($id){
       return $result = Post::find($id);
    }
    function updatePost(Request $req,$id){
        $rules = [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'user_id' => 'required',
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(["error"=>$validator->errors()]);
           }else
           {
            $post = Post::find($id);
            $post->user_id = $req->input('user_id');
            $post->title = $req->input('title');
            $post->description = $req->input('description');
            if($post->save()){
                return response()->json(['result'=>"Post Updated"]);
            }
            else{
                return response()->json(['error'=>"Something went wrong"]);
            }
           }        
     }
   
}
