<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingHistory extends Model
{
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function novel() { return $this->belongsTo(Novel::class); }
    public function chapter() { return $this->belongsTo(Chapter::class); }

    protected function casts(): array
    {
        return [
            'last_read_at' => 'datetime',
        ];
    }
}
