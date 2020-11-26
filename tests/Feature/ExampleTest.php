<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ExampleTest extends TestCase
{

    private $user;

    protected function setUp():void {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs(
            $this->user,
           ['*']
       );


    }
    protected function tearDown():void {
        parent::tearDown();
       unset( $this->user);


    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        
       
    
        $response = $this->get('/api/useremail');
        
    
        $response->assertStatus(200)->assertSee( $this->user->email);
     
    }

    public function testGetUser() {
        $response = $this->get('/api/user');
        $response->assertStatus(200);
    }
}
