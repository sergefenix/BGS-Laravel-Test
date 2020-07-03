@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('participants.create') }}">
                    <button type="button" class="btn btn-primary">Create</button>
                </a><br><br>
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
