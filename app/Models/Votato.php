<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votato extends Model
{
    use HasFactory;
    protected $table = 'votato';
    public const UPDATED_AT = null;
    public $fillable = [
        'user'
    ];
}
