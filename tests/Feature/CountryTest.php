<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return 
     */
    public function test_example()
    {
        $greeter = new countryController;

        $greeting = $greeter->index('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
    }
}
