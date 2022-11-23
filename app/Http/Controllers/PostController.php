<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Resources\Views\Posts\Show;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|image'
        
        ]);

        if($validator->fails()) {
            return back()->with('status', 'Somthing wrong!');
        }else {

            $imageName = time() . "." . $request->thumbnail->extension(); //7872878.jpg

            $request->thumbnail->move(public_path(path:'thumbnails'), $imageName);

              Post::create([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $imageName
         ]);
        }

        return redirect(route('posts.all'))->with('status', 'Post created successfully!');
    }

    public function show($postId) {

        $post = Post::findOrFail($postId);

        return view('posts.show',compact('post'));  //compact pass the view
    }

    public function edit($postId) {

        $post = Post::findOrFail($postId);

        return view('posts.edit', compact('post'));
    }

    public function update($postId, Request $request) {

        //dd($request->all());
        Post::findOrFail($postId)->update($request->all());

        return redirect(route('posts.all'))->with('status','Post Updated!');
    }

    public function delete($postId) {

        Post::findOrFail($postId)->delete();
        return redirect(route('posts.all'));
    }

 
}
