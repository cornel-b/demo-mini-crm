@extends('adminlte::page')
@section('title', 'Edit Employee')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Update Employee</div>
          <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                <div class="col-md-6">
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                         value="{{ old('first_name', $employee->first_name) }}" required autofocus>
                  @error('first_name')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                <div class="col-md-6">
                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                         value="{{ old('last_name', $employee->last_name) }}" required>
                  @error('last_name')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="company" class="col-md-4 col-form-label text-md-right">Company</label>
                <div class="col-md-6">
                  {!! Form::select('company_id',  $companyList, $employee->company_id, ['class' => 'form-control']) !!}
                  @error('company')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $employee->email) }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $employee->phone) }}">
                  @error('phone')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Create</button> &nbsp;
                  <a href="{{ route('employees.index') }}">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
