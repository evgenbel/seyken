@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.competition') }}" class="btn btn-primary">Отмена</a>
            </div>
            <br/>

            <form method="POST" action="{{ route('admin.competition.update', ['id'=>$competition->id]) }}">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Наименование</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ $competition->name }}" required autofocus>

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
                        <input id="start" type="text" class="form-control{{ $errors->has('start') ? ' is-invalid' : '' }}"
                               name="start" value="{{ $competition->start->format('d.m.Y') }}" required
                               data-provide="datepicker"
                               data-date-format="dd.mm.yyyy"
                               data-date-language="ru">

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
                        <input id="end" type="text" value="{{ $competition->end->format('d.m.Y') }}" class="form-control{{ $errors->has('end') ? ' is-invalid' : '' }}" name="end" required
                               data-provide="datepicker"
                               data-date-format="dd.mm.yyyy"
                               data-date-language="ru">

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
                            <option value="{{ $item->id }}"
                                    @foreach($competition->kates as $k)
                                    @if($k->id==$item->id)selected @endif
                                    @endforeach>{{ $item->name }} ({{ $item->koef }})</option>
                            @endforeach
                        </select>

                        @if ($errors->has('kata'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('kata') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                {{--<div class="form-group row">--}}
                    {{--<label for="end" class="col-md-4 col-form-label text-md-right">Судьи</label>--}}

                    {{--<div class="col-md-6">--}}
                        {{--<select multiple name="user[]" class="chosen">--}}
                            {{--@foreach($users as $item)--}}
                                {{--<option value="{{ $item->id }}"--}}
                                        {{--@foreach($competition->users as $k)--}}
                                        {{--@if($k->id==$item->id)selected @endif--}}
                                        {{--@endforeach>{{ $item->name }} (@if($item->set_kata) Ката @endif)</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}

                        {{--@if ($errors->has('user'))--}}
                            {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('user') }}</strong>--}}
                                    {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

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
                <table class="table">
                    <tr>
                        <td>ФИО</td>
                        <td>Город</td>
                        <td>Школа</td>
                        <td>Дата рождения</td>
                        <td>Вес</td>
                        <td></td>
                    </tr>
                    @foreach($competition->competitors as $competitor)
                        <tr>
                            <td>{{ $competitor->user->fio }}</td>
                            <td>{{ $competitor->user->city }}</td>
                            <td>{{ $competitor->user->school }}</td>
                            <td>{{ $competitor->user->date_birth->format('d.m.Y') }}</td>
                            <td>{{ $competitor->user->weight }}</td>
                            <td><a href="{{ route('admin.competition.remove',
                            [
                            'competition'   =>  $competition->id,
                            'competitor'   =>  $competitor->id,
                            ]) }}">Удалить</a></td>
                        </tr>
                    @endforeach
                </table>

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
