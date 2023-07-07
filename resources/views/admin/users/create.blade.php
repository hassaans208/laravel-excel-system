@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.users.main.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.users.fields.name') }}</label>
                <input class="form-control @error('name') 'is-invalid' @enderror" type="text" name="name" id="name"
                    value="{{ old('name', '') }}" >
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                {{-- <span class="help-block">{{ trans('cruds.order.fields.order_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.users.fields.email') }}</label>
                <input class="form-control @error('email') 'is-invalid' @enderror" type="email" name="email" id="email"
                    value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                {{-- <span class="help-block">{{ trans('cruds.order.fields.total_cost_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.users.fields.password') }}</label>
                <input class="form-control @error('password') 'is-invalid' @enderror" type="password" name="password"
                    id="password" value="{{ old('password') }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                {{-- <span class="help-block">{{ trans('cruds.order.fields.tax_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="password_confirmation">{{ trans('cruds.users.fields.password_confirmation') }}</label>
                <input class="form-control @error('password_confirmation') 'is-invalid' @enderror" type="password"
                    name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                {{-- <span class="help-block">{{ trans('cruds.order.fields.tax_helper') }}</span> --}}
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
