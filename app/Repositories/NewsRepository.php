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

    public function createNews(SaveNewsRequest $request)
    {
        $data = $request->validated();
        return $request->user()
            ? $request->user()->news()->create($data)
            : false;
    }

    public function updateNews(SaveNewsRequest $request, News $news)
    {
        $data = $request->validated();
        return $news->update($data);
    }
}
