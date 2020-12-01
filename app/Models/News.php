<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class News 最新消息
 */
class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'content'];
    protected $hidden = ['deleted_at'];

    /**
     * 建立者
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
