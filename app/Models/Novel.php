<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    protected $guarded = [];

    public function category() { return $this->belongsTo(Category::class); }
    public function chapters() { return $this->hasMany(Chapter::class); }
    public function bookmarks() { return $this->hasMany(Bookmark::class); }
}
