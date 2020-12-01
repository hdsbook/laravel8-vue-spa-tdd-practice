<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class Signing 表單簽核
 */
class Signing extends Model
{
    use HasFactory;

    protected $fillable = ['form_id'];

    /**
     * 簽核所屬表單
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * 簽核流程
     */
    public function signingProcesses()
    {
        return $this->hasMany(SigningProcess::class);
    }
}
