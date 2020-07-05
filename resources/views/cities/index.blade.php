@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('cities.create') }}">
                    <button type="button" class="btn btn-primary">Create</button>
                </a><br><br>
                <div class="card">
                    <div class="card-header">Cities</div>
                    <div class="content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Count Events</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{$city->id}}</td>
                                    <td>{{$city->name}}</td>
                                    <td>{{$city->countEvents()}}</td>
                                    <td><a href="{{ route('cities.show', [$city]) }}">
                                            <button type="button" class="btn btn-primary">Show</button>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-center">
                            {{ $cities->onEachSide(10)->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
