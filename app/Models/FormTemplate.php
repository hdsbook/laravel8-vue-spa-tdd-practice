<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class FormTemplate 表單模版
 */
class FormTemplate extends Model
{
    use HasFactory;

    /**
     * 使用此模版的表單
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
