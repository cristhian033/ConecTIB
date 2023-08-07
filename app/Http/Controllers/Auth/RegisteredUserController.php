<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Country;
use Illuminate\View\View;
use App\Events\UserCreate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Country::orderBy('name', 'asc')->get();
        return view('users.register', compact(['countries']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)
                                                                    ->numbers()
                                                                    ->symbols()
                                                                    ->mixedCase()],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['sometimes','nullable','string', 'max:10', 'min:10'],
            'document' => ['required','max:11'],
            'birth_date' => ['required','date', 'before:'.now()->subYears(18)->toDateString()],
            'city_id' => ['required'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'document' => $request->document,
            'birth_date' => $request->birth_date,
            'city_id' => $request->city_id,


        ]);

        event(new UserCreate($user));
        return Redirect::route('user.show')->with('status', 'profile-create');
    }
}
