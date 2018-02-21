<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    // protected $table = 'posts';
    // protected $primary_key = 'id';

    protected $fillable = ['title','content'];

    protected $date = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
