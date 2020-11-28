<?php

namespace App\Repositories;

use App\Http\Requests\News\SaveNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * class NewsRepository
 *
 * @property \App\Models\News $model
 */
class NewsRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\News::class;
    }

    public function getByPaginate($perPage = null)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function createNews($data)
    {
        return auth()->user()->news()->create($data);
    }

    public function updateNews($data, News $news)
    {
        return $news->update($data);
    }
}
