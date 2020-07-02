@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="btn-group mr-2" role="group" aria-label="Actions">
                    <a href="{{ route('participants.show', [$participant->id]) }}">
                        <button type="button" class="btn btn-warning">Back</button>
                    </a>
                    <form action="{{ route('participants.delete', [$participant->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <br><br>

                <h3>Participant Id: <span class="badge badge-secondary">{{$participant->id}}</span></h3>

                <form method="POST" action="{{ route('participants.update', [$participant->id]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$participant->name}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname"
                               value="{{$participant->surname}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{$participant->email}}">
                    </div>
                    <div class="form-group">
                        <label for="event_id">Event</label>
                        <select class="form-control" name="event_id">
                            @foreach($events as $event)
                                @if($event->name == $participant->event_id)
                                    <option value="{{$event->id}}" selected>{{$event->name}}</option>
                                @else
                                    <option value="{{$event->id}}">{{$event->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
