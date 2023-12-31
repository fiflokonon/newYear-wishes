<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = [
        'name',
        'message',
        'key',
        'access_code',
        'visibility',
        'link',
        'status'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
