<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Http\Request;

/**
 * class NewsRepository
 *
 * @property \App\Models\News $model
 */
class NewsRepository extends EloquentRepository
{
    public $model;

    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    }

    public function getByPaginate($perPage = null)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function createNews(Request $request)
    {
        $data = $this->validateRequest($request);
        return $request->user()
            ? $request->user()->news()->create($data)
            : false;
    }

    public function updateNews(Request $request, News $news)
    {
        $data = $this->validateRequest($request);
        return $news->update($data);
    }
}
