<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\GetUrlRankingsFromSearchResult;
use Mockery\MockInterface;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_displays_the_initial_main_page_with_no_rankings()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('No results');
        $response->assertSessionMissing('rankings');
    }

    /**
     * @test
     */
    public function it_should_prompt_a_required_error_message_when_a_required_field_is_empty()
    {
        $response = $this->post('/search');

        $response->assertRedirect(route('search.index'));
        $response->assertSessionHasErrors(['keyword', 'url']);
    }

    /**
     * @test
     */
    public function it_displays_the_main_page_with_rankings()
    {
        $this->mock(GetUrlRankingsFromSearchResult::class, function (MockInterface $mock) {
            $mock->shouldReceive('execute')->once()->andReturn(self::sampleRankings());
        });

        $response = $this->post('/search', [
            'keyword' => 'creditorwatch',
            'url' => 'creditorwatch.com.au',
        ]);

        $response->assertRedirect(route('search.index'));
        $response->assertSessionHas('rankings', self::sampleRankings());
    }

    private static function sampleRankings(): array
    {
        return [
            [
                'rank' => '1st',
                'title' => 'CreditorWatch: Business Credit Scores and Company Checks',
                'link' => 'https://creditorwatch.com.au/',
            ],
            [
                'rank' => '3rd',
                'title' => 'Login - Company Credit Check Services - CreditorWatch',
                'link' => 'https://creditorwatch.com.au/login',
            ],
        ];
    }

}
