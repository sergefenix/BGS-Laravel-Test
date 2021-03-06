@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('participants.create') }}">
                    <button type="button" class="btn btn-primary">Create</button>
                </a>

                <div class="dropdown float-right">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Events
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="?">All</a>
                        @foreach($events as $event)
                            <a class="dropdown-item" href="?event_id={{$event->id}}">{{$event->name}}</a>
                        @endforeach
                    </div>
                </div>
                <br><br>

                <div class="card">
                    <div class="card-header">Participants</div>
                    <div class="content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Event</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($participants as $participant)
                                <tr>
                                    <td>{{$participant->id}}</td>
                                    <td>{{$participant->name}}</td>
                                    <td>{{$participant->surname}}</td>
                                    <td>{{$participant->email}}</td>
                                    <td>{{$participant->event_id}}</td>
                                    <td><a href="{{ route('participants.show', [$participant]) }}">
                                            <button type="button" class="btn btn-primary">Show</button>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $participants->onEachSide(10)->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
