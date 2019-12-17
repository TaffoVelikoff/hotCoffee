<?php

namespace TaffoVelikoff\HotCoffee\Tests;

use TaffoVelikoff\HotCoffee\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase {

	use RefreshDatabase;
	
	/** @test */
	function a_role_can_be_created_with_the_factory()
    {	
        $post = factory(Role::class)->create();

        $this->assertCount(1, Role::all());
    }
}