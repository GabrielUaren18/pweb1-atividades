<?php

namespace Tests\Feature;

use Tests\TestCase;

class VeiculoControllerTest extends TestCase
{
    public function test_index_lists_vehicles_with_polymorphic_rates(): void
    {
        $response = $this->get(route('produtos.index'));

        $response->assertOk()
            ->assertSee('ABC1D23')
            ->assertSee('XYZ2E34')
            ->assertSee('BRA3F45')
            ->assertSee('QRS4G56')
            ->assertSee('R$ 40,00');
    }

    public function test_show_displays_the_selected_vehicle(): void
    {
        $this->get(route('produtos.show', 1))
            ->assertOk()
            ->assertSee('XYZ2E34')
            ->assertSee('CG 160')
            ->assertSee('R$ 15,00');
    }

    public function test_show_returns_not_found_for_an_unknown_index(): void
    {
        $this->get(route('produtos.show', 99))->assertNotFound();
    }
}
