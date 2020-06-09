<?php

namespace App\Http\Controllers;

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
        return view('admin.employees.create');
    }

    public function store(SaveEmployeeRequest $request)
    {
        Employee::create($request->all());

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', ['employee' => $employee]);
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
