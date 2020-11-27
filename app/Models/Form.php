<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['form_name', 'form_template_id'];

    public function createUser()
    {
        $this->belongsTo(User::class, 'create_user_id');
    }
}
