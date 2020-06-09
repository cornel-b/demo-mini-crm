<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\SaveEmployeeRequest;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    public function index(): View
    {
        $employees = Employee::paginate(10);

        return view('admin.employees.index', ['employees' => $employees]);
    }

    public function create()
    {
        $companies = Company::all()->pluck('name', 'id');

        return view('admin.employees.create', ['companies' => $companies]);
    }

    public function store(SaveEmployeeRequest $request)
    {
        Employee::create($request->all());

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all()->pluck('name', 'id');

        return view('admin.employees.edit', ['employee' => $employee, 'companies' => $companies]);
    }

    public function update(SaveEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
