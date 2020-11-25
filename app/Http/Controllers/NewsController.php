<?php

namespace App\Http\Controllers;

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

    public function fetchNews($perPage = null)
    {
        $perPage = (int) ($perPage ?: $this->perPage);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = $this->newsRepo->createNews($request);
        return response()->json([
            'success' => ($news !== false),
            'id' => $news ? $news->id : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $news = $this->newsRepo->updateNews($request, $news);
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
