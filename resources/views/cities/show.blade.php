@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="btn-group mr-2" role="group" aria-label="Actions">
                    <a href="{{ route('cities') }}">
                        <button type="button" class="btn btn-warning">Back</button>
                    </a>
                    <a href="{{ route('cities.edit', [$city->id]) }}">
                        <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                    <form action="{{ route('cities.delete', [$city->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <br><br>
                <h3>City Id: <span class="badge badge-secondary">{{$city->id}}</span></h3>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{$city->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Events</label>
                        <ul class="list-group">
                            @foreach($events as $event)
                                <li class="list-group-item">Name: {{$event->name}} |
                                    Date start: {{$event->date_start}}</li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
