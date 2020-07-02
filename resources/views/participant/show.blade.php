@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="btn-group mr-2" role="group" aria-label="Actions">
                    <a href="{{ route('participants') }}">
                        <button type="button" class="btn btn-warning">Back</button>
                    </a>
                    <a href="{{ route('participants.edit', [$participant->id]) }}">
                        <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                    <form action="{{ route('participants.delete', [$participant->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <br><br>
                <h3>Participant Id: <span class="badge badge-secondary">{{$participant->id}}</span></h3>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{$participant->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Surname</label>
                        <input type="text" class="form-control" id="surname" value="{{$participant->surname}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" value="{{$participant->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Event</label>
                        <input type="text" class="form-control" id="event" value="{{$participant->event_id}}" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
