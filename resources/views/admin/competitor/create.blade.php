@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.competitor') }}" class="btn btn-primary">Отмена</a>
            </div>
            <br/>
            <form method="POST" action="{{ route('admin.competitor.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">ФИО</label>

                    <div class="col-md-6">
                        <input id="fio" type="text" class="form-control{{ $errors->has('fio') ? ' is-invalid' : '' }}"
                               name="fio" value="{{ old('fio') }}" required autofocus>

                        @if ($errors->has('fio'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fio') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="group_id" class="col-md-4 col-form-label text-md-right">Категория</label>

                    <div class="col-md-6">
                        <select id="group_id" name="group_id" class="chosen">
                            @foreach($groups as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('group_id'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">Город</label>

                    <div class="col-md-6">
                        <input id="city" type="text" value="{{ old('city') }}"
                               class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" required>

                        @if ($errors->has('city'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="school" class="col-md-4 col-form-label text-md-right">Школа карате</label>

                    <div class="col-md-6">
                        <input id="school" type="text" value="{{ old('school') }}"
                               class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" required>

                        @if ($errors->has('school'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_birth" class="col-md-4 col-form-label text-md-right">Дата рождения</label>

                    <div class="col-md-6">
                        <input id="date_birth" type="text" value="{{ old('date_birth') }}"
                               class="form-control{{ $errors->has('date_birth') ? ' is-invalid' : '' }}" name="date_birth" required
                               data-provide="datepicker"
                               data-date-language="ru"
                               data-date-format="dd.mm.yyyy">

                        @if ($errors->has('date_birth'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_birth') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="weight" class="col-md-4 col-form-label text-md-right">Вес</label>

                    <div class="col-md-6">
                        <input id="weight" type="text" value="{{ old('weight') }}"
                               class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" required>

                        @if ($errors->has('weight'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('weight') }}</strong>
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
