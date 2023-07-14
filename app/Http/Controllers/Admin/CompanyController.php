<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        // get all companies
        $companies = Company::all();
        return response()->json( $companies );
    }

    /**
    * Store a newly created resource in storage.
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // validate request
        $request->validate( [
            'name' => 'required|string',
            'email' => 'email',
        ] );

        // create company
        $company = Company::create( $request->all() );

        // return response
        return response()->json( [
            'message' => __( 'Company created successfully' ),
            'company' => $company,
        ] );
    }

    /**
    * Display the specified resource.
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\Response
    */

    public function show( Company $company ) {
        // return response
        return response()->json( $company );
    }

    /**
    * Update the specified resource in storage.
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Company $company ) {
        // validate request
        $request->validate( [
            'name' => 'required|string',
            'email' => 'email',
        ] );

        // update company
        $company->update( $request->all() );

        // return response
        return response()->json( [
            'message' => __( 'Company updated successfully' ),
            'company' => $company,
        ] );
    }

    /**
    * Remove the specified resource from storage.
    * only if the company has no users
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\Response
    */

    public function destroy( Company $company ) {
        // check if company has users
        if ( $company->users()->count() > 0 ) {
            return response()->json( [
                'message' => __( 'Company has users' ),
            ], 403 );
        }

        // delete company
        $company->delete();

        // return response
        return response()->json( [
            'message' => __( 'Company deleted successfully' ),
        ] );
    }

    /**
    * Get all invitations for the company.
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\Response
    */

    public function invitations( Company $company ) {
        // get all invitations for the company
        $invitations = $company->invitations()->with( 'inviter', 'invitee' )->get();

        // return response
        return response()->json( $invitations );
    }

    /**
    * Get all users for the company.
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\Response
    */

    public function users( Company $company ) {
        // get all users for the company
        $users = $company->users()->with( 'roles' )->get();

        // return response
        return response()->json( $users );
    }

}
