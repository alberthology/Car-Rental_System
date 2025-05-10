<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RenterController extends BaseController
{
    public function renter()
    {
        return view('renterpage'); // Make sure the view file exists in app/Views/
    }

    public function cars()
    {
        return view('Renter/companycars'); // Make sure the view file exists in app/Views/
    }

    public function rent()
    {
        return view('Renter/rent'); // Make sure the view file exists in app/Views/
    }

    public function profile()
    {
        return view('Renter/profile'); // Make sure the view file exists in app/Views/
    }

    public function logout()
    {
        return view('loginpage'); // Make sure the view file exists in app/Views/
    }

    public function europcar()
    {
        return view('Renter/cars/europcar'); // Make sure the view file exists in app/Views/
    }

    public function hertz()
    {
        return view('Renter/cars/hertz'); // Make sure the view file exists in app/Views/
    }

    public function avis()
    {
        return view('Renter/cars/avis'); // Make sure the view file exists in app/Views/
    }

    public function alamo()
    {
        return view('Renter/cars/alamo'); // Make sure the view file exists in app/Views/
    }

    public function budget()
    {
        return view('Renter/cars/budget'); // Make sure the view file exists in app/Views/
    }

    public function national()
    {
        return view('Renter/cars/national'); // Make sure the view file exists in app/Views/
    }
    
    public function dollar()
    {
        return view('Renter/cars/dollar'); // Make sure the view file exists in app/Views/
    }

    public function thrifty()
    {
        return view('Renter/cars/thrifty'); // Make sure the view file exists in app/Views/
    }

    public function goldcar()
    {
        return view('Renter/cars/goldcar'); // Make sure the view file exists in app/Views/
    }

    public function sixt()
    {
        return view('Renter/cars/sixt'); // Make sure the view file exists in app/Views/
    }

    public function bookNow() {
        // Here you would add the booking details to the database
        session()->setFlashdata('success', 'Your car rental has been successfully booked!');
        redirect('Renter/companycars'); // Redirect back after booking
    }
    
    //europcar
    public function confirmBooking() {
        $data['car'] = $this->request->getGet('car');
        $data['price'] = $this->request->getGet('price');
        $data['start'] = $this->request->getGet('start');
        $data['end'] = $this->request->getGet('end');
        $data['total'] = $this->request->getGet('total');
    
        return view('confirm_booking', $data);
    }

    
    
    
    

}
