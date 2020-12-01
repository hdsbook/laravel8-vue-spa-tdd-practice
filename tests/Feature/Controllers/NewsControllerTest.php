<?php

namespace Tests\Feature\Controllers;

use App\Models\News;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class NewsControllerTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->signInById(1);
    }

    public function testFetchNews()
    {
        /** @given page and perPage */
        $perPage = 10;
        $page = 1;

        /** @when fetch news */
        $response = $this->getJson(route('news.fetch', [
            'perPage' => $perPage,
            'page' => $page,
        ]));

        /** @then confirm news data */
        $response->assertStatus(200)->assertJsonStructure([
            'data',
            'current_page',
            'last_page_url',
            'next_page_url',
            'per_page',
            'to',
            'total'
        ]);

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
        /** @given news id */
        $news = News::factory()->create(['user_id' => $this->user]);
        $id = $news->id;

        /** @when send fetch request */
        $response = $this->getJson(route('news.find', ['id' => $id]));

        /** @then confirm news data correct */
        $response->assertJson($news->toArray());
    }

    public function testStore()
    {
        /** @given create data */
        $createData = [
            'title' => $this->faker->name,
            'content' => $this->faker->text(20)
        ];

        /** @when send create request */
        $response = $this->postJson(route('news.store'), $createData)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'id'
            ])
            ->json();

        /** @then confirm created */
        $this->assertNotNull($response['id']);

        $news = News::find($response['id']);
        $this->assertEquals($createData['title'], $news->title);
        $this->assertEquals($createData['content'], $news->content);
    }

    public function testUpdateNews()
    {
        /** @given news and update data */
        $news = News::factory()->create(['user_id' => $this->user]);
        $updateData = [
            'title' => $this->faker->name,
            'content' => $this->faker->text(20),
        ];

        /** @when update */
        $this->patchJson(route('news.update', $news), $updateData)
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        /** @then check updated */
        $newsAfter = News::find($news->id);
        $this->assertEquals($newsAfter->title, $updateData['title']);
        $this->assertEquals($newsAfter->content, $updateData['content']);
    }

    public function testDestroy()
    {
        /** @given spcific news */
        $news = News::factory()->create(['user_id' => $this->user]);

        /** @when delete */
        $this->deleteJson(route('news.destroy', $news))
            ->assertStatus(200)
            ->assertJson(['success' => true]);

        /** @then check deleted */
        $this->assertSoftDeleted('news', ['id' => $news->id]);
    }
}
