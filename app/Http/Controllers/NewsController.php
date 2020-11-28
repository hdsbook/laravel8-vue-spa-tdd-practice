<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\SaveNewsRequest;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

/**
 * class NewsController
 *
 * @property NewsRepository $newsRepo
 */
class NewsController extends Controller
{
    protected $perPage = 5;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
        $this->middleware('web');
        $this->middleware('auth')->only(['store', 'update', 'destroy']);
    }

    public function fetchNews(Request $request)
    {
        $perPage = (int) ($request->perPage ?: $this->perPage);
        $news = $this->newsRepo->getByPaginate($perPage);
        return response()->json($news);
    }

    public function fetchNewsById(Request $request)
    {
        $news = $this->newsRepo->getById($request->id);
        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\News\SaveNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveNewsRequest $request)
    {
        $data = $request->validated();
        $news = $this->newsRepo->createNews($data);
        return response()->json([
            'success' => ($news !== false),
            'id' => $news ? $news->id : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\News\SaveNewsRequest  $request
     * @param  \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(SaveNewsRequest $request, News $news)
    {
        $data = $request->validated();
        $news = $this->newsRepo->updateNews($data, $news);
        return response()->json([
            'success' => ($news !== false)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        return response()->json([
            'success' => $news->delete(),
        ]);
    }
}
