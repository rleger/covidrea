<?php

namespace Tests\Feature;

use App\User;
use App\Service;
use Tests\TestCase;
use App\Etablissement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MettreAJourMesLitsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_peut_acceder_a_la_page()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        $response->assertStatus(200);
        $response->assertSee('Mettre à jour mes lits');
        $response->assertSee('Votre compte n’a pas de service');
        $response->assertDontSee('Mise à jour des données');
    }

    /** @test */
    public function un_utilisateur_voit_le_formulaire_pour_modifier()
    {
        $user = factory(User::class)->make();
        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create(['etablissement_id' => $etablissement->id])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        $response->assertStatus(200);
        $response->assertDontSee('Votre compte n’a pas de service');
        $response->assertSee('Mettre à jour mes lits');
        $response->assertSee('Mise à jour des données');
        $response->assertSee('Places totales');
        $response->assertSee('Places disponibles');
        $response->assertSee('Places bientôt disponibles');
    }

    /** @test */
    public function un_utilisateur_peut_modifier_les_lits_de_son_service()
    {
        $user = factory(User::class)->make();
        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create([
                    'etablissement_id'         => $etablissement->id,
                    'place_totales'            => 30,
                    'place_disponible'         => 10,
                    'place_bientot_disponible' => 10,
                ])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        $service = $user->services->first();
        // Old plaxes
        $places = [
            'place_totales'            => $service->place_totales,
            'place_disponible'         => $service->place_disponible,
            'place_bientot_disponible' => $service->place_bientot_disponible,
        ];
        // Post change
        $this
            ->followingRedirects()
            ->from(route('user.services.edit'))
            ->patch(route('user.services.update', ['service' => $service->id]), [
                'place_totales'            => $places['place_totales'] + 30,
                'place_disponible'         => $places['place_disponible'] + 1,
                'place_bientot_disponible' => $places['place_bientot_disponible'] + 1,
            ])
            ->assertSuccessful();
        // Refresh model
        $service->refresh();
        // Assertions
        $this->assertEquals($service->place_totales, $places['place_totales'] + 30);
        $this->assertEquals($service->place_disponible, $places['place_disponible'] + 1);
        $this->assertEquals($service->place_bientot_disponible, $places['place_bientot_disponible'] + 1);
    }

    /** @test */
    public function un_utilisateur_ne_peut_pas_modifier_les_lits_dun_autre_service()
    {
        $user = factory(User::class)->make();
        $user2 = factory(User::class)->make();
        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create([
                    'etablissement_id'         => $etablissement->id,
                    'place_totales'            => 30,
                    'place_disponible'         => 10,
                    'place_bientot_disponible' => 10,
                ])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });
        $etablissement2 = factory(Etablissement::class, 1, ['user_id' => $user2->id])
            ->create()
            ->each(function ($etablissement) use ($user2) {
                factory(Service::class, 1)->create([
                    'etablissement_id'         => $etablissement->id,
                    'place_totales'            => 20,
                    'place_disponible'         => 5,
                    'place_bientot_disponible' => 5,
                ])->each(
                    function ($service) use ($user2) {
                        $service->users()->save($user2);
                    }
                );
            });
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        // Service of ANOTHER USER
        // ************************
        $service = $user2->services->first();
        // Old plaxes
        $places = [
            'place_totales'            => $service->place_totales,
            'place_disponible'         => $service->place_disponible,
            'place_bientot_disponible' => $service->place_bientot_disponible,
        ];
        // Post change
        $this
            ->followingRedirects()
            ->from(route('user.services.edit'))
            ->patch(route('user.services.update', ['service' => $service->id]), [
                'place_totales'            => $places['place_totales'] + 30,
                'place_disponible'         => $places['place_disponible'] + 1,
                'place_bientot_disponible' => $places['place_bientot_disponible'] + 1,
            ])
            ->assertForbidden();
        // Refresh model
        $service->refresh();
        // Assertions
        $this->assertEquals($service->place_totales, $places['place_totales']);
        $this->assertEquals($service->place_disponible, $places['place_disponible']);
        $this->assertEquals($service->place_bientot_disponible, $places['place_bientot_disponible']);
    }

    /** @test */
    public function le_nombre_de_place_totale_ne_peut_pas_etre_inf_a_la_somme_des_deux_autres()
    {
        $user = factory(User::class)->make();
        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create([
                    'etablissement_id'         => $etablissement->id,
                    'place_totales'            => 30,
                    'place_disponible'         => 10,
                    'place_bientot_disponible' => 10,
                ])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        $service = $user->services->first();
        // Post change
        $this
            ->followingRedirects()
            ->from(route('user.services.edit'))
            ->patch(route('user.services.update', ['service' => $service->id]), [
                'place_totales'            => 5,
                'place_disponible'         => 10,
                'place_bientot_disponible' => 10,
            ])
            ->assertSuccessful()
            ->assertSee('Le nombre de places totales ne peut pas exceder la somme des places disponibles et bientôt disponibles');
        // Refresh model
        $service->refresh();
        // Assertions
        $this->assertEquals($service->place_totales, 30);
        $this->assertEquals($service->place_disponible, 10);
        $this->assertEquals($service->place_bientot_disponible, 10);
    }

    /** @test */
    public function le_nombre_de_place_doit_etre_un_chiffre_valide()
    {
        $user = factory(User::class)->make();
        $etablissement = factory(Etablissement::class, 1, ['user_id' => $user->id])
            ->create()
            ->each(function ($etablissement) use ($user) {
                factory(Service::class, 1)->create([
                    'etablissement_id'         => $etablissement->id,
                    'place_totales'            => 30,
                    'place_disponible'         => 10,
                    'place_bientot_disponible' => 10,
                ])->each(
                    function ($service) use ($user) {
                        $service->users()->save($user);
                    }
                );
            });
        $response = $this->actingAs($user)->get(route('user.services.edit'));
        $service = $user->services->first();
        // Post change
        $this
            ->followingRedirects()
            ->from(route('user.services.edit'))
            ->patch(route('user.services.update', ['service' => $service->id]), [
                'place_totales'            => 'wrong',
                'place_disponible'         => 200,
                'place_bientot_disponible' => 'number',
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.integer', [
                'attribute' => __('validation.attributes')['place_totales'],
            ]))
            ->assertSee(__('validation.max.numeric', [
                'attribute' => __('validation.attributes')['place_disponible'],
                'max'       => '100',
            ]))
            ->assertSee(__('validation.integer', [
                'attribute' => __('validation.attributes')['place_bientot_disponible'],
            ]));

        // Refresh model
        $service->refresh();

        // Assertions that record was not updated
        $this->assertEquals($service->place_totales, 30);
        $this->assertEquals($service->place_disponible, 10);
        $this->assertEquals($service->place_bientot_disponible, 10);
    }
}
