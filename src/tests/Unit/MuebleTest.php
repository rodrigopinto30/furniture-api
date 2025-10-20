<?php

namespace Tests\Unit;

use App\Models\Mueble;
use PHPUnit\Framework\TestCase;

class MuebleTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_can_create_mueble()
    {
        $mueble = Mueble::factory()->make();
        $this->assertInstanceOf(Mueble::class, $mueble);
    }
}
