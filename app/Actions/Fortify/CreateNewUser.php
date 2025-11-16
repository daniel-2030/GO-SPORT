<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
public function create(array $input): User
{
    Validator::make($input, [
        'nombre' => ['required', 'string', 'max:255'],
        'apellidos' => ['nullable', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'telefono' => ['nullable', 'string', 'max:20'],
        'tipo_documento' => ['nullable', 'string', Rule::in(['CC', 'TI', 'CE'])],
        'numero_identificacion' => ['nullable', 'string', 'max:50'],
        'genero' => ['nullable', 'string', Rule::in(['Masculino', 'Femenino', 'Otro'])],
        'password' => $this->passwordRules(),
    ])->validate();

    return User::create([
        'nombre' => $input['nombre'],
        'apellidos' => $input['apellidos'] ?? null,
        'email' => $input['email'],
        'telefono' => $input['telefono'] ?? null,
        'tipo_documento' => $input['tipo_documento'] ?? null,
        'numero_identificacion' => $input['numero_identificacion'] ?? null,
        'genero' => $input['genero'] ?? null,
        'password' => Hash::make($input['password']),
    ]);
}
}
