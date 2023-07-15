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
        $data = request()->validate( [
            'name' => 'required',
            'email' => 'email|nullable',
            'website' => 'url|nullable',
        ],
        [
            'name.required' => 'Ce champ est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
        ] );

        Company::create( $data );

        return redirect()->route( 'companies.index' )->with( 'success', 'Société créée avec succes.' );

    }

}
