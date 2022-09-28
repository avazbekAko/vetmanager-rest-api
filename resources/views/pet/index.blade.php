@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clients-all', $ids['id']) }}" enctype="multipart/form-data">Back</a>
                    <a class="btn btn-success" href="{{ url('/connection/'.$ids['id'].'/client/'.$ids['id_client'].'/pet-create') }}"> Create Pet</a>
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
                    <td>id</td>
                    <td>lab_number</td>
                    <td>alias</td>
                    <td>type</td>
                    <td>breed</td>
                    <td>пол</td>
                    <td>weight</td>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $re)
                    <tr>
                        <td>{{ $re->id }}</td>
                        <td>{{ $re->lab_number }}</td>
                        <td>{{ $re->alias }}</td>
                        <td>{{ $re->type }}</td>
                        <td>{{ $re->breed }}</td>
                        <td>{{ $re->sex }}</td>
                        <td>{{ $re->weight }}</td>

                        <td>
                            <a class="btn btn-primary" href="{{ url('/connection/'.$ids['id'].'/client/'.$ids['id_client'].'/pet/'.$re->id.'/edit') }}">Edit</a>
                            <a href="{{ url('/connection/'.$ids['id'].'/client/'.$ids['id_client'].'/pet/'.$re->id.'/delete') }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection
