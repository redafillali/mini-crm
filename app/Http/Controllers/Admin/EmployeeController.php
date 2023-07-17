<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class EmployeeController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        // get all user with role employee
        $employees = User::role( 'employee' )->get();
        return Inertia::render( 'Employees/Index', [
            'employees' => $employees
        ] );
    }
}
