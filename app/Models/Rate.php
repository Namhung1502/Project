<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Rate extends Model
{
    use HasFactory;
    protected $table = 'rate';
    protected $fillable = [
        'rate', 'id_blog', 'id_user'
    ];
    protected $timestamp = true;
}
