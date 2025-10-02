<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Validation\ValidationException;
use SensitiveParameter;

class Login extends BaseLogin
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getUsernameFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])->statePath('data');
    }

    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('usernameOrEmail')
            ->label(__('auth.usernameOrEmail.label'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        $login_type = filter_var($data['usernameOrEmail'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        return [
            $login_type => $data['usernameOrEmail'],
            'password'  => $data['password'],
        ];
    }

    /**
     * @throws ValidationException
     */
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.usernameOrEmail' => __('auth.usernameOrEmail.messages.failed'),
        ]);
    }
}
