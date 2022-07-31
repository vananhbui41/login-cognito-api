<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'cognito_user_id',
        // 'email',
    ]; 
}
