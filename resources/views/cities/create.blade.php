@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('cities') }}">
                    <button type="button" class="btn btn-warning">Back</button>
                </a><br><br>
                <h3>City: <span class="badge badge-secondary">Create</span></h3>

                <form method="POST" action="{{ route('cities.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
