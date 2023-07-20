<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller {
    /**
    * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
    */

    public function update( Request $request ): RedirectResponse {
        try{
            $request->validate( [
                'name' => [ 'required', 'max:255' ],
                'email' => [ 'required', 'email', 'max:255', 'unique:users,email,' . $request->user()->id ],
                'address' => [ 'required', 'max:255' ],
                'phone' => [ 'required', 'max:255' ],
                'birthdate' => [ 'required', 'date' ],
            ] );

            $request->user()->forceFill( [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
            ] )->save();
            return Redirect::route('profile.edit')->with([
                'message' => 'Profil mis à jour avec succès.',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with([
                'message' => 'Une erreur est survenue lors de la mise à jour du profil.',
                'status' => 'error'
            ]);
        }
    }

    /**
     * Delete the user's account.
        */

        public function destroy( Request $request ): RedirectResponse {
            $request->validate( [
                'password' => [ 'required', 'current_password' ],
            ] );

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to( '/' );
        }
    }
