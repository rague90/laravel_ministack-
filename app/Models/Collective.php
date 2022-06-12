<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collective extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','user_id','members','category_id','slug','deleted_at'

];

public function question()
{
    return $this->hasMany(Question::class);
}

public function user(){
    return $this->belongsTo(User::class);
}
public function owner($user_id)
{
    return auth()->user()->id === $user_id;

}

}
