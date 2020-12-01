<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class Form 表單
 */
class Form extends Model
{
    use HasFactory;

    protected $fillable = ['form_name', 'form_template_id'];


    /**
     * 表單建立者
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }

    /**
     * 表單模版
     */
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    /**
     * 表單簽核
     */
    public function signing()
    {
        return $this->hasOne(Signing::class);
    }
}
