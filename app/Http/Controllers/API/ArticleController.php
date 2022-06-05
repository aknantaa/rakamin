<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Validator;
class ArticleController extends Controller
{

    public $successStatus = 200;

    public function list(){
        $article = Article::all();
        return response()->json([
            "success" => true,
            "message" => "Articles list",
            "data" => $article
        ]);
    }

    public function show($id){
        $article = Article::find($id);
        if(is_null($article)){
            return response()->json(['error' => "Data kosong"], 401);
        }
        return response()->json([
            "success" => true,
            "message" => "Article retrieved",
            "data" => $article
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);
        if  ($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $article = Article::create($input);
        $success['token'] = $article->createToken('nApp')->accessToken;
        $success['title'] = $article->title;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function update(Request $request, Article $article){
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        $article->title = $input['title'];
        $article->content = $input['content'];
        $article->save();
        return response()->json([
            "success" => true,
            "message" => "Articles has been updated",
            "data" => $article
        ]);
    }
    public function destroy($id){
        Article::destroy($id);
        return response()->json([
            'success' => true,
            'message' => "Article has been deleted",
        ]);
    }
    
}
