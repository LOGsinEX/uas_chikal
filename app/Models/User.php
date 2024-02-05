<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable

{

    public function products()

    {

        return $this->hasMany(Product::class);

    }

}
