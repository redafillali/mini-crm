<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller {

    /**
    * display a listing of the resource.
    * using Inertia
    * @return \Inertia\Response
    */

    public function index() {
        $companies = Company::all();
        return Inertia::render( 'Companies/Index', [
            'companies' => $companies
        ] );
    }

    /**
    * Show the form for creating a new resource.
    * using Inertia
    * @return \Inertia\Response
    */

    public function create() {
        return Inertia::render( 'Companies/Create' );
    }

    /**
    * Store a newly created resource in storage.
    * @return \Illuminate\Http\RedirectResponse
    */

    public function store() {
        try {
            $this->validate( request(), [
                'name' => 'required',
                'email' => 'email|nullable',
                'website' => 'url|nullable',
                'address' => 'nullable',
                'phone' => 'nullable',
            ] );
            $this->authorize( 'create', Company::class );
            Company::create( request()->all() );
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Société créée avec succès.',
                'type' => 'success',
            ] );
        } catch ( \Exception $e ) {
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Une erreur est survenue lors de la création de la société.',
                'type' => 'error',
            ] );
        }
    }

    /**
    * Show the form for editing the specified resource.
    * using Inertia
    * @param \App\Models\Company $company
    * @return \Inertia\Response
    */

    public function edit( Company $company ) {
        //  form model binding
        $company->load( 'users' );
        return Inertia::render( 'Companies/Edit', [
            'company' => $company
        ] );
    }

    /**
    * Update the specified resource in storage.
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\RedirectResponse
    */

    public function update( Company $company ) {
        try {
            $this->validate( request(), [
                'name' => 'required',
                'email' => 'email|nullable',
                'website' => 'url|nullable',
                'address' => 'nullable',
                'phone' => 'nullable',
            ] );
            $company->update( request()->all() );
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Société mise à jour avec succès.',
                'type' => 'success',
            ] );
        } catch ( \Exception $e ) {
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Une erreur est survenue lors de la mise à jour de la société.',
                'type' => 'error',
            ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    * Only if the company has no users
    * @param \App\Models\Company $company
    * @return \Illuminate\Http\RedirectResponse
    */

    public function destroy( Company $company ) {
        try {
            $this->authorize( 'delete', $company );
            $company->delete();
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Société supprimée avec succès.',
                'type' => 'success',
            ] );
        } catch ( \Exception $e ) {
            return redirect()->route( 'companies.index' )->with( [
                'message' => 'Une erreur est survenue lors de la suppression de la société.',
                'type' => 'error',
            ] );
        }
    }

}
