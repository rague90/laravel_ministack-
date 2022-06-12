<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','user_id','collective_id','votes','category_id','slug','deleted_at'];

public function collective(){
    return $this->belongsTo(Collective::class)->withDefault([
                    'title' => 'Not Available'
    ]);
}
public function User(){
    return $this->belongsTo(User::class);
}

public function Category(){
    return $this->belongsTo(Category::class);
}

public function owner($user_id)
{
    return auth()->user()->id === $user_id;

}



 public function getRouteKeyName()
 {
       return 'slug';
 }
}