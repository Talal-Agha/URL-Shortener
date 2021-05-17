<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ShortLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UrlShortnerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_can_create_a_shortcode()
    {
        $this->withoutExceptionHandling();


        $user = User::factory()->make();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

      //  $link = ShortLink::factory()->make();
        
        $response = $this->post('/url-shortener', [
            'link' => "https://google.com",
            
        ]);

        // $link->assertOk();

        $response->assertRedirect('/url-shortener');
        
    }


    //  /** @test */
    // public function a_new_shortcode_has_a_unique_code() {

    //     $this->withoutExceptionHandling();


    //     $user = User::factory()->make();
    //     $this->actingAs($user);
    //     $this->assertTrue(Auth::check());


    //     $response = $this->post('url-shortener', [
    //         'link' => "https://google.com",
    //     ]);

    //     $this->assertSessionHasErrors('code');
    // }


    // /** @test */
    // public function an_authenticated_user_can_delete_one_of_their_shortcodes() {

    // }
    // /** @test */
    // public function an_authenticated_user_cannot_delete_a_shortcode_of_another_user() {

    // }
    /** @test */
    // public function a_guest_user_cannot_add_or_delete_shortcodes() {
    //     $this->withoutExceptionHandling();

    //     $user = User::factory()->make();
    //         $this->actingAs($user);
    //         $this->assertTrue(Auth::check());

    //     $link = ShortLink::factory()->make();

    //     $response = $this->delete('/url-shortener/'.$link->id);

    //     $response->assertOk();
    // }

    /** @test */
    // public function an_invalid_shortcode_returns_404() {

    //     $response = $this->get('/wwww'); // invalide code
    //     $response->assertSee('404');
    // }

    /** @test */
    public function a_valid_shortcode_redirects_to_the_expected_url() {
        
     // $this->withoutExceptionHandling();
       $link = ShortLink::factory()->make();
       $response = $this->get('/'.$link->code);
       $response->assertStatus(200);

    }
}
