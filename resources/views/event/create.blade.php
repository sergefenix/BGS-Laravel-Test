@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('events') }}">
                    <button type="button" class="btn btn-warning">Back</button>
                </a><br><br>
                <h3>Event: <span class="badge badge-secondary">Create</span></h3>

                <form method="POST" action="{{ route('events.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="date_start">Date Start</label>
                        <input type="date" class="form-control" id="date_start" name="date_start">
                    </div>
                    <div class="form-group">
                        <label for="city_id">Event</label>
                        <select class="form-control" name="city_id">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
