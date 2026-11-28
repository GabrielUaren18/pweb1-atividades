<?php

namespace Tests\Feature;

use Tests\TestCase;

class EstacionamentoControllerTest extends TestCase
{
    public function test_resource_creates_shows_and_deletes_a_composition(): void
    {
        $this->get(route('estacionamentos.index'))
            ->assertOk()
            ->assertSee('Nenhum estacionamento cadastrado.');

        $this->get(route('estacionamentos.create'))
            ->assertOk()
            ->assertSee('ABC1D23')
            ->assertSee('XYZ2E34');

        $this->post(route('estacionamentos.store'), [
            'nome' => 'Unidade Central',
            'veiculos' => ['ABC1D23', 'XYZ2E34'],
        ])
            ->assertRedirect(route('estacionamentos.show', 1))
            ->assertSessionHas('sucesso');

        $this->get(route('estacionamentos.show', 1))
            ->assertOk()
            ->assertSee('Unidade Central')
            ->assertSee('ABC1D23')
            ->assertSee('XYZ2E34');

        $this->get(route('estacionamentos.edit', 1))
            ->assertOk()
            ->assertSee('value="Unidade Central"', false)
            ->assertSee('Salvar alterações');

        $this->put(route('estacionamentos.update', 1), [
            'nome' => 'Unidade Norte',
            'veiculos' => ['XYZ2E34'],
        ])
            ->assertRedirect(route('estacionamentos.show', 1))
            ->assertSessionHas('sucesso');

        $this->get(route('estacionamentos.show', 1))
            ->assertOk()
            ->assertSee('Unidade Norte')
            ->assertSee('XYZ2E34')
            ->assertDontSee('ABC1D23');

        $this->delete(route('estacionamentos.destroy', 1))
            ->assertRedirect(route('estacionamentos.index'))
            ->assertSessionHas('sucesso');

        $this->get(route('estacionamentos.index'))
            ->assertOk()
            ->assertSee('Nenhum estacionamento cadastrado.');

        $this->get(route('estacionamentos.show', 1))->assertNotFound();
    }

    public function test_resource_rejects_an_unknown_vehicle(): void
    {
        $this->from(route('estacionamentos.create'))
            ->post(route('estacionamentos.store'), [
                'nome' => 'Unidade Central',
                'veiculos' => ['INVALIDA'],
            ])
            ->assertRedirect(route('estacionamentos.create'))
            ->assertSessionHasErrors('veiculos.0');
    }
}
