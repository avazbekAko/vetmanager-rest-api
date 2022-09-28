@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ url('/connection/'.$id.'/client-create') }}"> Create Client</a>
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
                    <th>Город</th>
                    <th>Адрес</th>
                    <th>Баланс</th>
                    <th>Последний счет</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $re)
                    <tr>
                        <td>{{ $re->id }}</td>
                        <td>{{ $re->last_name." ".$re->first_name }}</td>
                        <td>{{ $re->city }}</td>
                        <td>{{ $re->address }}</td>
                        <td>{{ floor($re->balance*100)/100 }} руб.</td>
                        <td>{{ $re->last_visit_date }}</td>
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
