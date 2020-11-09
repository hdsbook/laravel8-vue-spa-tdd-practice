<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Http\Request;

/**
 * class NewsRepository
 *
 * @property News $model
 */
class NewsRepository extends EloquentRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function createNews(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        return $request->user()
            ? $request->user()->news()->create($data)
            : false;
    }
}
