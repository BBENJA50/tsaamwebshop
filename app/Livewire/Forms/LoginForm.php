<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = ''; // Validatie voor email veld

    #[Validate('required|string')]
    public string $password = ''; // Validatie voor wachtwoord veld

    #[Validate('boolean')]
    public bool $remember = false; // Validatie voor remember me checkbox

    /**
     * Probeer de inloggegevens te verifiëren.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited(); // Controleer of de gebruiker niet rate limited is

        if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            RateLimiter::hit($this->throttleKey()); // Verhoog de rate limiter

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'), // Gooi een validatiefout als inloggen mislukt
            ]);
        }

        RateLimiter::clear($this->throttleKey()); // Maak de rate limiter leeg bij succesvolle login
    }

    /**
     * Zorg ervoor dat het authenticatieverzoek niet rate limited is.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return; // Ga door als er minder dan 5 pogingen zijn gedaan
        }

        event(new Lockout(request())); // Trigger een lockout evenement

        $seconds = RateLimiter::availableIn($this->throttleKey()); // Bereken de resterende tijd

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60), // Geef een validatiefout als de gebruiker rate limited is
            ]),
        ]);
    }

    /**
     * Haal de throttle key voor rate limiting op.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip()); // Genereer een throttle key op basis van email en IP adres
    }
}
