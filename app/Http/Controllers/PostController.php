<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request) {

      $post = new Post;
      $post->title= $request->title;
      $post->user()->associate($requeast->user());

      $review = new Review;
      $review->body = $requeast->body;
      $review->user()->associate($request->user());

      $post->save();
      $post->reviews()->save($review);
    }
}
