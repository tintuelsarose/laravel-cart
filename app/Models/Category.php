<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public static function status()
    {
        return [
            1 => 'Yes',
            0 => 'No'
        ];
    }
}
