@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="btn-group mr-2" role="group" aria-label="Actions">
                    <a href="{{ route('events') }}">
                        <button type="button" class="btn btn-warning">Back</button>
                    </a>
                    <form action="{{ route('events.delete', [$event->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <br><br>
                <h3>Event Id: <span class="badge badge-secondary">{{$event->id}}</span></h3>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{$event->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date_start">Date start</label>
                        <input type="text" class="form-control" id="date_start" value="{{$event->date_start}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="city_id">City</label>
                        <input type="text" class="form-control" id="city_id" value="{{$event->city_id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Participants</label>
                        <ul class="list-group">
                            @foreach($participants as $participant)
                                <li class="list-group-item">Name: {{$participant->name}} {{$participant->surname}} |
                                    Email: {{$participant->email}}</li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
