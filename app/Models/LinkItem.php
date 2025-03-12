<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'link_id'];

    public function link(){
        return $this->belongsTo(Link::class);
    }
}
