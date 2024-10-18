<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\app\http\Controllers\TaskController;


class Task extends Model
{
    use softDeletes;

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'long_description',
    ];
    
}
