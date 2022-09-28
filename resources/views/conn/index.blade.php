@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-3">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ url('/connection/'.$id.'/client-create') }}"> Create Client</a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="pull-right">
                    <form action="/connection/{{$id}}/clients-search" method="GET">
                        <input type="text" name="search" class="form-control" placeholder="search" value="@if (isset($_GET['search'])){{ $_GET['search'] }}@endif">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary ml-3">search</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N</th>
                    <th>ФИО</th>
                    <th>Питомцы</th>
                    <th>Город</th>
                    <th>Адрес</th>
                    <th>Баланс</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $re)
                    <tr>
                        <td>{{ $re->id }}</td>
                        <td>{{ $re->last_name." ".$re->first_name }}</td>
                        <td>{{ $re->pet }}</td>
                        <td>{{ $re->city }}</td>
                        <td>{{ $re->address }}</td>
                        <td>{{ floor($re->balance*100)/100 }} руб.</td>
                        <td>
                            <a class="btn btn-primary" href="{{ url('/connection/'.$id.'/client/'.$re->id.'/edit') }}">Edit</a>
                            <a href="{{ url('/connection/'.$id.'/client/'.$re->id.'/delete') }}" class="btn btn-danger">Delete</a>
                            <a class="btn btn-success" href="{{ url('/connection/'.$id.'/client/'.$re->id.'/pets-all') }}">View</a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection
