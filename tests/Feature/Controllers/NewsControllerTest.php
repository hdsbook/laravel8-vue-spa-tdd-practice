<?php

namespace Tests\Feature\Controllers;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class NewsControllerTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testFetchNews()
    {
        $perPage = 10;
        $page = 11;

        $response = $this->getJson(route('news.fetch', [
            'perPage' => $perPage,
            'page' => $page,
        ]))->assertStatus(200)->assertJsonStructure([
            'data',
            'current_page',
            'last_page_url',
            'next_page_url',
            'per_page',
            'to',
            'total'
        ])->json();

        $this->assertLessThanOrEqual($response['data'], $perPage);
        if (count($response['data'])) {
            $firstNews = $response['data'][0];
            $this->assertArrayHasKey('id', $firstNews);
            $this->assertArrayHasKey('user_id', $firstNews);
            $this->assertArrayHasKey('content', $firstNews);
            $this->assertArrayHasKey('title', $firstNews);
        }
    }

    public function testFetchNewsById()
    {
        $news = News::factory()->create(['user_id' => $this->user]);
        $this->getJson(route('news.find', [
            'id' => $news->id
        ]))->assertJson($news->toArray());
    }

    public function testStore()
    {
        $createData = [
            'title' => '123',
            'content' => '456'
        ];
        $response = $this->postJson(route('news.store'), $createData)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'id'
            ])
            ->json();

        $this->assertNotNull($response['id']);

        $news = News::find($response['id']);
        $this->assertEquals($createData['title'], $news->title);
        $this->assertEquals($createData['content'], $news->content);
    }

    public function testUpdateNews()
    {
        $news = News::factory()->create(['user_id' => $this->user]);
        $updateData = [
            'title' => '123',
            'content' => '456',
        ];

        $this->patchJson(route('news.update', $news), $updateData)
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        $newsAfter = News::find($news->id);
        $this->assertEquals($newsAfter->title, $updateData['title']);
        $this->assertEquals($newsAfter->content, $updateData['content']);
    }

    public function testDestroy()
    {
        $news = News::factory()->create(['user_id' => $this->user]);

        $this->deleteJson(route('news.destroy', $news))
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertSoftDeleted('news', ['id' => $news->id]);
    }
}
