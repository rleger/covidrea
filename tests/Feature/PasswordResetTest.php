<?php

namespace Tests\Feature;

use Str;
use Hash;
use App\User;
use Password;
use Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const ROUTE_PASSWORD_EMAIL = 'password.email';
    const ROUTE_PASSWORD_REQUEST = 'password.request';
    const ROUTE_PASSWORD_RESET = 'password.reset';
    const ROUTE_PASSWORD_RESET_SUBMIT = 'password.update';

    const USER_ORIGINAL_PASSWORD = 'secret';

    /**
     * Testing showing the password reset request page.
     */
    public function testShowPasswordResetRequestPage()
    {
        $this
            ->get(route(self::ROUTE_PASSWORD_REQUEST))
            ->assertSuccessful()
            ->assertSee(__('Reset Password'))
            ->assertSee(__('E-Mail Address'))
            ->assertSee(__('Send Password Reset Link'));
    }

    /**
     * Testing submitting the password reset request with an invalid
     * email address.
     */
    public function testSubmitPasswordResetRequestInvalidEmail()
    {
        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => Str::random(),
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));
    }

    /**
     * Testing submitting the password reset request with an email
     * address not in the database.
     */
    public function testSubmitPasswordResetRequestEmailNotFound()
    {
        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => $this->faker->unique()->safeEmail,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.user'));
    }

    /**
     * Testing submitting a password reset request.
     */
    public function testSubmitPasswordResetRequest()
    {
        $user = factory(User::class)->create();

        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => $user->email,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.sent'));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * Testing showing the reset password page.
     */
    public function testShowPasswordResetPage()
    {
        $user = factory(User::class)->create();

        $token = Password::broker()->createToken($user);

        $this
            ->get(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->assertSuccessful()
            ->assertSee(__('Reset Password'))
            ->assertSee(__('E-Mail Address'))
            ->assertSee(__('Password'))
            ->assertSee(__('Confirm Password'));
    }

    /**
     * Testing submitting the password reset page with an email
     * address not in the database.
     */
    public function testSubmitPasswordResetEmailNotFound()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            // ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
            ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
                'token'                 => $token,
                'email'                 => $this->faker->unique()->safeEmail,
                'password'              => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee('Aucun utilisateur');

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing submitting the password reset page.
     */
    public function testSubmitPasswordReset()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
                'token'                 => $token,
                'email'                 => $user->email,
                'password'              => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful();

        $this->assertAuthenticatedAs($user, $guard = null);
        $user->refresh();

        $this->assertFalse(Hash::check(self::USER_ORIGINAL_PASSWORD, $user->password));

        $this->assertTrue(Hash::check($password, $user->password));
    }
}
