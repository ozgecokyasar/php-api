<?php

namespace App;
use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   use Orderable;
  protected $fillable = ['body'];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function post() {
    return $this->belongsTo(Post::class);
  }
}
