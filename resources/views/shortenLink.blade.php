
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('URL Shortener') }}</div>

                <div class="card-header">
        <form method="POST" action="{{ route('shortener.store') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit">Generate Link</button>
              </div>
            </div>
        </form>
      </div>

            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p class="m-0">{{ Session::get('success') }}</p>
                </div>
            @endif
            <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shortener.show', $row->code) }}" target="_blank">{{ route('shortener.show', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>
                                <form method="POST" action="{{ route('shortener.destroy', [ 'id'=> $row->id ]) }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-link btn-sm text-danger" href="">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
