<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // Show all employees
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    // Show form to create a new employee
    public function create()
    {
        return view('employee.create'); // Make sure your Blade file exists at resources/views/employee/create.blade.php
    }

    // Store a new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')
                         ->with('success', 'Employee added successfully');
    }

    // Show form to edit an employee
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    // Update an employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        $employee->update($request->all());

        return redirect()->route('employee.index')
                         ->with('success', 'Employee updated successfully');
    }

    // Delete an employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
                         ->with('success', 'Employee deleted successfully');
    }
}
