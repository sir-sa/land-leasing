<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable =['image','title_deed','name','cash','desscription','email','phone','amenity','utility'];
}
