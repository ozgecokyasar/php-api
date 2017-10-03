<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Transformers\PostTransformer;

class PostController extends Controller
{
  public function index() {
    $posts = Post::latestFirst()->get();
    return fractal()->collection($posts)->parseIncludes(['user'])->transformWith(new PostTransformer)->toArray();
  }

    public function store(StorePostRequest $request) {

      $post = new Post;
      $post->title= $request->title;
      $post->user()->associate($request->user());

      $review = new Review;
      $review->body = $request->body;
      $review->user()->associate($request->user());

      $post->save();
      $post->reviews()->save($review);

      return fractal()->item($post)->parseIncludes(['user', 'reviews', 'reviews.user'])->transformWith(new PostTransformer)->toArray();
    }
}
