@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.competition') }}" class="btn btn-primary">Отмена</a>
            </div>
            <br/>

            <form method="POST" action="{{ route('admin.competition.store') }}">
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
                    <label for="start" class="col-md-4 col-form-label text-md-right">Начало</label>

                    <div class="col-md-6">
                        <input id="start" type="text"
                               value="{{ old('start') }}" class="form-control{{ $errors->has('start') ? ' is-invalid' : '' }}"
                               name="start" required
                               data-provide="datepicker"
                               data-date-language="ru"
                        data-date-format="dd.mm.yyyy">

                        @if ($errors->has('start'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end" class="col-md-4 col-form-label text-md-right">Окончание</label>

                    <div class="col-md-6">
                        <input id="end"
                               data-provide="datepicker"
                               data-date-format="dd.mm.yyyy"
                               data-date-language="ru"
                               type="text" value="{{ old('end') }}"
                               class="form-control{{ $errors->has('end') ? ' is-invalid' : '' }}"
                               name="end" required>

                        @if ($errors->has('end'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="end" class="col-md-4 col-form-label text-md-right">Каты</label>

                    <div class="col-md-6">
                        <select multiple name="kata[]" class="chosen">
                            @foreach($kata as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }} ({{ $item->koef }})
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('kata'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('kata') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end" class="col-md-4 col-form-label text-md-right">Участники</label>

                    <div class="col-md-6">
                        <select multiple name="competitor[]" class="chosen">
                            @foreach($competitors as $item)
                                <option value="{{ $item->id }}">{{ $item->fio }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('competitor'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('competitor') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end" class="col-md-4 col-form-label text-md-right">Группа</label>

                    <div class="col-md-6">
                        <select name="group_id" class="chosen">
                            @foreach($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('competitor'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('competitor') }}</strong>
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
