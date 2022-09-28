@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Company</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clients-all', $id) }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ url('/connection/'.$id.'/client/'.$res->id.'/edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client Last name:</strong>
                        <input type="text" name="last_name" class="form-control" value="{{ $res->last_name }}">
                        @error('last_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client first name:</strong>
                        <input type="text" name="first_name" class="form-control" value="{{ $res->first_name }}">
                        @error('first_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client middle name:</strong>
                        <input type="text" name="middle_name" class="form-control" value="{{ $res->middle_name }}">
                        @error('middle_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client passport series:</strong>
                        <input type="text" name="passport_series" class="form-control" value="{{ $res->passport_series }}">
                        @error('passport_series')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client home phone:</strong>
                        <input type="text" name="home_phone" class="form-control" value="{{ $res->home_phone }}">
                        @error('home_phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client work phone:</strong>
                        <input type="text" name="work_phone" class="form-control" value="{{ $res->work_phone }}">
                        @error('work_phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client cell phone:</strong>
                        <input type="text" name="cell_phone" class="form-control" value="{{ $res->cell_phone }}">
                        @error('cell_phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client email:</strong>
                        <input type="text" name="email" class="form-control" value="{{ $res->email }}">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client city_id:</strong>
                        <input type="text" name="city_id" class="form-control" value="{{ $res->city_id }}">
                        @error('city_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client street_id:</strong>
                        <input type="text" name="street_id" class="form-control" value="{{ $res->street_id }}">
                        @error('street_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client apartment:</strong>
                        <input type="text" name="apartment" class="form-control" value="{{ $res->apartment }}">
                        @error('apartment')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client zip:</strong>
                        <input type="text" name="zip" class="form-control" value="{{ $res->zip }}">
                        @error('zip')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client discount:</strong>
                        <input type="text" name="discount" class="form-control" value="{{ $res->discount }}">
                        @error('discount')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client number_of_journal:</strong>
                        <input type="text" name="number_of_journal" class="form-control" value="{{ $res->number_of_journal }}">
                        @error('number_of_journal')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client type_id:</strong>
                        <input type="text" name="type_id" class="form-control" value="{{ $res->type_id }}">
                        @error('type_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client how_find:</strong>
                        <input type="text" name="how_find" class="form-control" value="{{ $res->how_find }}">
                        @error('how_find')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client unsubscribe:</strong>
                        <input type="text" name="unsubscribe" class="form-control" value="{{ $res->unsubscribe }}">
                        @error('unsubscribe')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Client in_blacklist:</strong>
                        <input type="text" name="in_blacklist" class="form-control" value="{{ $res->in_blacklist }}">
                        @error('in_blacklist')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
@endsection

