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

    public function test_registration_validates_fields_and_persists_vehicle_in_session(): void
    {
        $this->from(route('produtos.create'))
            ->post(route('produtos.store'))
            ->assertRedirect(route('produtos.create'))
            ->assertSessionHasErrors(['tipo', 'placa', 'modelo', 'horas']);

        $this->from(route('produtos.create'))
            ->post(route('produtos.store'), [
                'tipo' => 'carro',
                'placa' => 'ABC1E23',
                'modelo' => 'Hatch',
                'horas' => 'texto',
            ])
            ->assertRedirect(route('produtos.create'))
            ->assertSessionHasErrors('horas');

        $this->post(route('produtos.store'), [
            'tipo' => 'van',
            'placa' => 'DEF2G34',
            'modelo' => 'Utilitária',
            'horas' => '2.5',
        ])
            ->assertRedirect(route('produtos.index'))
            ->assertSessionHas('sucesso');

        $this->get(route('produtos.index'))
            ->assertOk()
            ->assertSee('DEF2G34')
            ->assertSee('Utilitária');
    }
}
