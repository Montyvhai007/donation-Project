<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Developer extends Authenticatable
{
    use HasFactory;

    // Define the fields that can be mass-assigned
    protected $fillable = ['name', 'email', 'password'];

    // Define the fields that should be hidden
    protected $hidden = ['password'];

    // Optionally, you can add the following if you want to use the 'remember me' functionality
    protected $rememberTokenName = 'remember_token';
}
