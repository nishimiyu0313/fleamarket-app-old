<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserlogoutTest extends TestCase
{
    public function test_ログアウトができる()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

      
        $this->actingAs($user);

      
        $response = $this->post('/logout');

        
        $this->assertGuest();

       
        $response->assertRedirect('/');
    }
   
}
