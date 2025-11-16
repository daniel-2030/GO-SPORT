<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nombre' => ['required', 'string', 'max:255'],
        'apellidos' => ['nullable', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'telefono' => ['nullable', 'string', 'max:20'],
        'tipo_documento' => ['nullable', 'string', 'in:CC,TI,CE'],
        'numero_identificacion' => ['nullable', 'string', 'max:50'],
        'genero' => ['nullable', 'string', 'in:Masculino,Femenino,Otro'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'nombre' => $request->nombre,
        'apellidos' => $request->apellidos,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'tipo_documento' => $request->tipo_documento,
        'numero_identificacion' => $request->numero_identificacion,
        'genero' => $request->genero,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
