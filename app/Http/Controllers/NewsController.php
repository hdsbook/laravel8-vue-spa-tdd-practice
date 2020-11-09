<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * class NewsController
 *
 * @property NewsRepository $newsRepo
 */
class NewsController extends Controller
{
    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
        $this->middleware('web');
        $this->middleware('auth')->only(['store']);
    }

    public function fetchNews(Request $request)
    {
        $news = $this->newsRepo->getAll();
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
        return response()->json([
            'success' => $this->newsRepo->createNews($request),
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
        return response()->json([
            'success' => $this->newsRepo->updateNews($request, $news)
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
