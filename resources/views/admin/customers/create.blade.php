@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.customers.main.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.customers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.customers.fields.name') }}</label>
                <input class="form-control @error('name') 'is-invalid' @enderror" type="text" name="name" id="name"
                    value="{{ old('name', '') }}" >
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.customers.fields.email') }}</label>
                <input class="form-control @error('email') 'is-invalid' @enderror" type="email" name="email" id="email"
                    value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="required" for="phone_no">{{ trans('cruds.customers.fields.phone_no') }}</label>
                <input class="form-control @error('phone_no') 'is-invalid' @enderror" type="phone_no" name="phone_no"
                    id="phone_no" value="{{ old('phone_no') }}">
                @error('phone_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
