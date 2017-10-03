<?php

namespace App\Transformers;

use App\User;

class UserTransformer extends \League\Fractal\TransformerAbstract {
  public function Transform(User $user)  {
    return [
      'username' => $user->name,

    ];
  }

}

 ?>
