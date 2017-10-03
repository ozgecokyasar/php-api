<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use Orderable;

  protected $fillable = ['title', 'body'];


    public function user() {
      return $this->belongsTo(User::class);
    }
    public function reviews() {
      return $this->hasMany(Review::class)->oldestFirst();
    }


}
