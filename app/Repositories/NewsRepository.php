<?php

namespace App\Repositories;

use App\Models\News;

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
}
