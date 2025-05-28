<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorApplication extends Model
{
    protected $table = 'author_applications';

    protected $fillable = [
        'name',
        'email',
        'bio',
        'portfolio',
    ];
}