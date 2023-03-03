<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Packages\Infrastructures\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample(): void
    {
        User::create([
            'name'     => 'name',
            'username' => 'username',
            'password' => Hash::make('password')
        ]);
        $this->assertEquals(1, User::where('name', 'name')->count());
    }
}
