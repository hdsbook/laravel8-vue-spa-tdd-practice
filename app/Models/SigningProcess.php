<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class SigningProcess 表單簽核流程
 */
class SigningProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign_user_id',
        'signing_id',
        'sequence',
    ];

    /**
     * 流程所屬簽核
     */
    public function signing()
    {
        return $this->belongsTo(Signing::class);
    }
}
