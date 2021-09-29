<?php

namespace Tests\Feature\Http\Controllers;

use App\5;
use App\Subscribe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ThreadSubscriptionsController
 */
class ThreadSubscriptionsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $subscribes = factory(Subscribe::class, 3)->create();

        $response = $this->get(route('subscribe.index'));

        $response->assertOk();
        $response->assertViewIs('subscribe.index');
        $response->assertViewHas('subscribes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('subscribe.create'));

        $response->assertOk();
        $response->assertViewIs('subscribe.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ThreadSubscriptionsController::class,
            'store',
            \App\Http\Requests\SubscribeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $email = $this->faker->safeEmail;
        $coupon_code = factory(5::class)->create();
        $date = $this->faker->date();

        $response = $this->post(route('subscribe.store'), [
            'email' => $email,
            'coupon_code' => $coupon_code->id,
            'date' => $date,
        ]);

        $subscribes = Subscribe::query()
            ->where('email', $email)
            ->where('coupon_code', $coupon_code->id)
            ->where('date', $date)
            ->get();
        $this->assertCount(1, $subscribes);
        $subscribe = $subscribes->first();

        $response->assertRedirect(route('subscribe.index'));
        $response->assertSessionHas('subscribe.id', $subscribe->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $subscribe = factory(Subscribe::class)->create();

        $response = $this->get(route('subscribe.show', $subscribe));

        $response->assertOk();
        $response->assertViewIs('subscribe.show');
        $response->assertViewHas('subscribe');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $subscribe = factory(Subscribe::class)->create();

        $response = $this->get(route('subscribe.edit', $subscribe));

        $response->assertOk();
        $response->assertViewIs('subscribe.edit');
        $response->assertViewHas('subscribe');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ThreadSubscriptionsController::class,
            'update',
            \App\Http\Requests\SubscribeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $subscribe = factory(Subscribe::class)->create();
        $email = $this->faker->safeEmail;
        $coupon_code = factory(5::class)->create();
        $date = $this->faker->date();

        $response = $this->put(route('subscribe.update', $subscribe), [
            'email' => $email,
            'coupon_code' => $coupon_code->id,
            'date' => $date,
        ]);

        $subscribe->refresh();

        $response->assertRedirect(route('subscribe.index'));
        $response->assertSessionHas('subscribe.id', $subscribe->id);

        $this->assertEquals($email, $subscribe->email);
        $this->assertEquals($coupon_code->id, $subscribe->coupon_code);
        $this->assertEquals($date, $subscribe->date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $subscribe = factory(Subscribe::class)->create();

        $response = $this->delete(route('subscribe.destroy', $subscribe));

        $response->assertRedirect(route('subscribe.index'));

        $this->assertDeleted($subscribe);
    }
}
