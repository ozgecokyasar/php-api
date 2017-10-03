<?php

namespace App\Transformers;

use App\Post;

class PostTransformer extends \League\Fractal\TransformerAbstract {

protected $availableIncludes = ['user'];

  public function Transform(Post $post)  {
    return [
      'id' => $post->id,
      'title'=> $post->title,
      'body'=>$post->body

    ];
  }

  public function includeUser(Post $post) {
    return $this->item($post->user, new UserTransformer);
  }

  public function includeReviews(Post $post) {
    return $this->collection($post->reviews, new ReviewTransformer);
  }

}
