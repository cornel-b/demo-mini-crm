@extends('adminlte::page')
@section('title', 'Add New Company')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Add New Company</div>
          <div class="card-body">
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                         value="{{ old('name') }}" required autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>
                <div class="col-md-6">
                  {!! Form::file('logo') !!}
                  @error('logo')
                  <div role="alert"><strong>{{ $message }}</strong></div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Website</label>
                <div class="col-md-6">
                  <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}">
                  @error('website')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Create</button> &nbsp;
                  <a href="{{ route('companies.index') }}">
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
