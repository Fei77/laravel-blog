<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use App\Category;
use App\Tag;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PostResource::collection(
            Post::latest()->paginate($request->input('limit', 20))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::firstOrCreate(
            ['name' => $request->category] 
        );
        
        $tags = [];

        $post = new Post;
        
        $post->category_id = $category->id;
        $post->author_id = 1;
        $post->title = $request->title;
        $post->save();

        $post->handleSave($request);

        foreach($request->input('tags', []) as $name) {
            $tag = Tag::firstOrCreate(
                ['name' => $name] 
            );

            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param slug $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostResource(Post::whereSlug($slug)->firstOrFail());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check if post exists
     * 
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function isExists(Request $request) {
        return response()->json(Post::where('title', $request->title)->exists());
    }
}
