<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\Company;
use App\Mail\InvitationMail;

class InvitationController extends Controller {
    /**
    * Display a listing of the resource.
    * using Inertia
    * @return \Inertia\Response
    */

    public function index() {
        $invitations = Invitation::paginate( 25 );
        return Inertia::render( 'Invitations/Index', [
            'invitations' => $invitations
        ] );
    }

    /**
    * Show the form for creating a new resource.
    * using Inertia
    * @return \Inertia\Response
    */

    public function create() {
        return Inertia::render( 'Invitations/Create', [
            'companies' => Company::all(),
        ] );
    }

    /**
    * Store a newly created resource in storage.
    * using Inertia
    * @param  \Illuminate\Http\Request  $request
    */

    public function store( Request $request ) {
        try {
            $request->validate( [
                'company' => 'required|exists:companies,id',
                'invitee_email' => 'required|email|unique:invitations,invitee_email',
            ] );

            $invitation = Invitation::create( [
                'invitee_email' => $request->invitee_email,
                'token' => sha1( $request->invitee_email . time() ),
            ] );

            $invitation->company()->associate( $request->company );
            $invitation->inviter()->associate( auth()->user()->id );
            $invitation->save();

            $this->sendInvitation( $invitation );
            return redirect()->route( 'invitations.index' )->with( [
                'message' => 'Invitation créée avec succès.',
                'type' => 'success',
            ] );
        } catch ( \Exception $e ) {
            dd( $e->getMessage() );
            return redirect()->route( 'invitations.index' )->with( [
                'message' => 'Une erreur est survenue lors de la création de l\'invitation.',
                'type' => 'error',
            ] );
        }
    }

    /**
    * Send an invitation email to the invitee.
    * @param  \App\Models\Invitation  $invitation
    */
    public function sendInvitation(Invitation $invitation)
    {
        try {
            Mail::to($invitation->invitee_email)->send(new InvitationMail($invitation->getInvitationUrl()));
        } catch (\Exception $e) {
            return redirect()->route('invitations.index')->with([
                'message' => 'Une erreur est survenue lors de l\'envoi de l\'invitation.',
                'type' => 'error',
            ] );
        }
    }

    /**
     * Accept invitation form
     * @param  string  $token
     */

    public function acceptInvitationForm( $token ) {
        $invitation = Invitation::where( 'token', $token )->firstOrFail();
        return Inertia::render( 'Auth/RegisterEmployee', [
            'invitation' => $invitation,
        ] );
    }

    /**
     * Accept invitation
     * Create a new user and assign the employee role
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     */

    public function acceptInvitation( Request $request, ) {
        try {
            $request->validate( [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|confirmed|min:8',
                'token' => 'required|string|exists:invitations,token',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'birthdate' => 'required|date',
            ] );

            $invitation = Invitation::where( 'token', $request->token )->firstOrFail();
            // Check if the invitation is still pending
            if ( !$invitation || $invitation->status !== 'pending' ) {
                return redirect()->route( 'dashboard' )->with( [
                    'message' => 'Cette invitation n\'est plus valide.',
                    'type' => 'error',
                ] );
            }
            $user = User::create( [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt( $request->password ),
                'address' => $request->address,
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
                'is_active' => true,
            ] );

            $user->assignRole( 'employee' );
            $user->company()->associate( $invitation->company );
            $user->save();

            $invitation->status = 'accepted';
            $invitation->save();

            return redirect()->route( 'dashboard' )->with( [
                'message' => 'Invitation acceptée avec succès.',
                'type' => 'success',
            ] );
        } catch ( \Exception $e ) {
            return redirect()->route( 'dashboard' )->with( [
                'message' => 'Une erreur est survenue lors de l\'acceptation de l\'invitation.',
                'type' => 'error',
            ] );
        }
    }
}
