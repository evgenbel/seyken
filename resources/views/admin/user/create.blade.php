@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.user') }}" class="btn btn-primary">Отмена</a>
            </div>
            <br/>

            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Наименование</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">email</label>

                    <div class="col-md-6">
                        <input id="email" type="text" value="{{ old('email') }}"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
