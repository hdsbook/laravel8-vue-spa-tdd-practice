<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SigningProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign_user_id',
        'signing_id',
        'sequence',
    ];
}
