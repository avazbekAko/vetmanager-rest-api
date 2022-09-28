@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Pet</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clients-all', $ids['id']) }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ url('/connection/'.$ids['id'].'/client/'.$ids['id_client'].'/pet-create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet alias:</strong>
                        <input type="text" name="alias" class="form-control" placeholder="Pet alias">
                        @error('alias')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet пол:</strong>
                        <input type="text" name="sex" class="form-control" placeholder="Pet пол">
                        @error('sex')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet type_id:</strong>
                        <input type="text" name="type_id" class="form-control" placeholder="Pet type_id" required>
                        @error('type_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet breed_id:</strong>
                        <input type="text" name="breed_id" class="form-control" placeholder="Pet breed_id" required>
                        @error('breed_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet color_id:</strong>
                        <input type="text" name="color_id" class="form-control" placeholder="Pet color_id">
                        @error('color_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet weight:</strong>
                        <input type="text" name="weight" class="form-control" placeholder="Pet weight">
                        @error('weight')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet birthday:</strong>
                        <input type="text" name="birthday" class="form-control" placeholder="Pet birthday">
                        @error('birthday')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet chip_number:</strong>
                        <input type="text" name="chip_number" class="form-control" placeholder="Pet chip_number">
                        @error('chip_number')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pet lab_number:</strong>
                        <input type="text" name="lab_number" class="form-control" placeholder="Pet lab_number">
                        @error('lab_number')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
