<?php

namespace Tests\Feature;

use App\User;
use App\Service;
use Tests\TestCase;
use App\Etablissement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LitDisponiblesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_with_no_etablissement_sees_a_message()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('etablissements.index'));

        $response->assertSee('Vous n’avez pas d’établissement de référence.');
    }

    /** @test */
    public function a_user_with_an_etablissement_sees_a_list()
    {
        $user = factory(User::class)->create();

        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create(['etablissement_id' => $etablissement->id])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });

        $lits_disponbibles = $etablissement->first()->service()->sum('place_disponible') . " disponibles";
        $lits_bientot_disponbibles = $etablissement->first()->service()->sum('place_bientot_disponible') . " prochainement";

        // Assert response
        $response = $this->actingAs($user)->get(route('etablissements.index'));

        $response->assertDontSee('Vous n’avez pas d’établissement de référence.');

        $response->assertSee($etablissement->first()->name);
        $response->assertSee($etablissement->first()->ville);
        $response->assertSee($etablissement->first()->type);
        $response->assertSee($lits_disponbibles);
        $response->assertSee($lits_bientot_disponbibles);
    }
}
