@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('events.create') }}">
                    <button type="button" class="btn btn-primary">Create</button>
                </a><br><br>
                <div class="card">
                    <div class="card-header">Events</div>
                    <div class="content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Date start</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{$event->id}}</td>
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->city_id}}</td>
                                    <td>{{$event->date_start}}</td>
                                    <td><a href="{{ route('events.show', [$event]) }}">
                                            <button type="button" class="btn btn-primary">Show</button>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $events->onEachSide(5)->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
