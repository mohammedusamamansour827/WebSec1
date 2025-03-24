<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function listCustomers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('employees.customers', compact('customers'));
    }

    public function addCreditForm(User $customer)
{
    return view('employees.add_credit', compact('customer'));
}

public function addCredit(Request $request, User $customer)
{
    $request->validate(['credit' => 'required|numeric|min:0']);

    $customer->credit += $request->credit;
    $customer->save();

    return redirect()->route('employees.customers')->with('success', 'Credit added successfully.');
}

protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'customer', // Default to customer
        'credit' => 0
    ]);
}

public function listCustomers()
{
    $customers = User::where('role', 'customer')->get();
    return view('employees.customers', compact('customers'));
}

public function addCreditForm(User $customer)
{
    return view('employees.add_credit', compact('customer'));
}

public function addCredit(Request $request, User $customer)
{
    $request->validate(['credit' => 'required|numeric|min:0']);
    $customer->credit += $request->credit;
    $customer->save();

    return redirect()->route('employees.customers')->with('success', 'Credit added.');
}

}
