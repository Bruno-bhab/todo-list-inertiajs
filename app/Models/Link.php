<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'logo', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function linkItems(){
        return $this->hasMany(LinkItem::class);
    }
}
