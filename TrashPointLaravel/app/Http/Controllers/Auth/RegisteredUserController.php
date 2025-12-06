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

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Masyarakat;

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
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNumber' => $request->phoneNumber ?? '',
            'role' => $request->role ?? '',
            'status' => $request->status ?? 'active',
        ]);

        if ($request->role == 'admin') {
            Admin::create([
                'idUser' => $user->idUser
            ]);
        } elseif ($request->role == 'petugas') {
            Petugas::create([
                'idUser' => $user->idUser
            ]);
        } elseif ($request->role == 'masyarakat') {
            Masyarakat::create([
                'idUser' => $user->idUser,
            ]);
        }

        // return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
