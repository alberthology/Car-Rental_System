<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('loginpage');
    }

    public function Adminpage(): string
    {
        return view('adminpage');
    }
    public function Renterpage(): string
    {
        return view('renterpage');
    }
    public function Cars(): string
    {
        return view('companycars');
    }

    public function company(): string
    {
        return view('RentalCompany/companypage');
    }
}
