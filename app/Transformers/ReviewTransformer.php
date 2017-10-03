<?php

namespace App\Transformers;


use App\Review;


class ReviewTransformer extends \League\Fractal\TransformerAbstract {

protected $availableIncludes = ['user'];

  public function transform(Review $review)  {
    return [
      'id' => $review->id,
      'body'=>$review->body
    ];
  }

  public function includeUser(Review $review) {
    return $this->item($review->user, new UserTransformer);
  }
  
  public function includePost(Review $review) {
    return $this->item($review->post, new PostTransformer);
  }
}
