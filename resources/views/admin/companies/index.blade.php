@extends('adminlte::page')
@section('title', 'Manage Companies')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Manage Companies</div>
          <div class="card-body">
            <a class="btn btn-primary float-right" href="{{ route('companies.create') }}">Add Company</a>
            <br/><br/>
            @if($errors->any())
              {{ implode('', $errors->all(':message')) }}
            @endif
            <table class="table">
              <thead>
              <tr>
                <th><strong>Info</strong></th>
                <th><strong>Contact</strong></th>
                <th colspan="2">Actions</th>
              </tr>
              </thead>
              @forelse($companies as $company)
                <tr>
                  <td><strong>{{ $company->name }}</strong><br/>
                    @if ($company->logo)
                      <img src="{{asset('storage/logos/' . $company->logo)}}" width="200">
                    @endif
                  </td>
                  <td>{{ $company->email  }}<br/>{{ $company->website }}</td>
                  <td><a class="btn btn-secondary" href="{{ route('companies.edit', $company->id)  }}">Edit</a></td>
                  <td>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the company?')">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">No Companies Found.</td>
                </tr>
              @endforelse
            </table>
            {{ $companies->render() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
