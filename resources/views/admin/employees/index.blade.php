@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Manage Employees</div>
          <div class="card-body">
            <a class="btn btn-primary float-right" href="{{ route('employees.create') }}">Add Employee</a>
            <br/><br/>
            <table class="table">
              <thead>
              <tr>
                <th><strong>Name</strong></th>
                <th><strong>Email</strong></th>
                <th colspan="2">Actions</th>
              </tr>
              </thead>
              @forelse($employees as $employee)
                <tr>
                  <td>{{ $employee->first_name  }} {{ $employee->last_name  }}</td>
                  <td>{{ $employee->email  }}</td>
                  <td><a class="btn btn-secondary" href="{{ route('employees.edit', $employee->id)  }}">Edit</a></td>
                  <td>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the employee?')">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">No Employees Found.</td>
                </tr>
              @endforelse
            </table>
            {{ $employees->render() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
