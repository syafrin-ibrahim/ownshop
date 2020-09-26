<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['category_id','title','slug','description','price','author','publisher','cover','stock','status','created_by'];

   public function category(){
        return $this->belongsTo("App\Category");
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
