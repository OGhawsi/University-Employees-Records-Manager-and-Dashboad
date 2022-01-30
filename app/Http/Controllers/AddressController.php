<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Address;
use App\Models\Employee;
use Illuminate\Http\Request;

class AddressController extends Controller
{
   
    public function create(Employee $employee)
    {
        return Inertia::render('Address/Create', [
            'employee' => $employee,
        ]);
    }

    public function store(Employee $employee)
    {
        Address::create(
            request()->validate([
               'employee_id' => ['max:255','required'],
               'contact_no' => ['max:12','required'],
               'email' => ['email','unique:addresses,email','max:255'],
               'province' =>['max:255'],
               'province_english' =>['max:255', 'required'],
               'address_type' =>['max:1','required'],
               'street_address' =>['max:255'],
               'street_address_english' =>['max:255', 'required'],
               'completed' =>['boolean'],
               
            ])
        );
        return redirect()->route('employee.show',$employee)
                        ->with(['toast' => ['message' => 'Address added successfully']]);;
    
    }

    public function edit(Address $address)
    {
        return Inertia::render('Address/Edit', [
            'address' => $address,
            'employee' => $address->employee
        ]);
    }

    public function update(Request $request, Address $address)
    {
        $address->update(
            request()->validate([
                'employee_id' => ['max:255','required'],
               'contact_no' => ['max:12','required'],
               'email' => ['email','max:255',
                            'unique:addresses,email,'.$address->id],
               'province' =>['max:255'],
               'province_english' =>['max:255', 'required'],
               'address_type' =>['max:1','required'],
               'street_address' =>['max:255'],
               'street_address_english' =>['max:255', 'required'],
               'completed' =>['boolean'],
               
            ])
        );
        return redirect()
                ->route('employee.show', $address->employee_id)
                ->with(['toast' => ['message' => 'Address updated successfully']]);;
    
    }

    public function destroy(Address $address)
    {
        $employee = $address->employee_id;
        $address->delete();
        return redirect()->route('employee.show', $employee)
                ->with(['toast' => ['message' => 'Address removed successfully']]);
    }
}
