<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Transformers\PostTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class PostController extends Controller
{
  public function index() {
    $posts = Post::latestFirst()->paginate(3);
    $postsCollection = $posts->getCollection();

    return fractal()->collection($postsCollection)->parseIncludes(['user'])->transformWith(new PostTransformer)->paginateWith(new IlluminatePaginatorAdapter($posts))->toArray();
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
