@extends('layouts.app')

@section('content')
    <div class="container1">
        <div class="justify-content-center">
            @foreach($list as $round=>$groups)
                <h1>Раунд {{ $round }}</h1><br/>
                @foreach($groups as $group=>$competitors)
                <h2>Категория {{ $group }}</h2>
                <form method="post" action="{{ route('disbaledround') }}">
                    @csrf
                    <table class="table">
                        <tr>
                            @if ($currentRound==$round)
                                <td rowspan="2">Искл</td>
                            @endif
                            <td rowspan="2">Место</td>
                            <td rowspan="2">ФИО</td>
                            <td rowspan="2">Средний балл</td>
                            <td rowspan="2">Ката</td>
                            @if ($currentRound==$round)
                                <td rowspan="2">Старт</td>
                            @endif
                            @foreach($users as $user)
                                <td colspan="2">{{ $user->name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach($users as $user)
                                @foreach($user->typePoints as $typePoint)
                                    <td>{{ $typePoint->name }}</td>
                                @endforeach
                            @endforeach
                        </tr>
                        @foreach($list[$round][$group] as $k=>$competitor)
                            @if($competitor->disabled_round>0 && $competitor->disabled_round<$round)
                                @continue;
                            @endif
                            <tr @if($competitor->disabled_round>0  && $competitor->disabled_round==$round) class="disabled" @endif
                            @if($competitor->is_current && $currentRound==$round) class="current" @endif>
                                @if ($currentRound==$round)
                                    <td><input type="checkbox" name="exclude[]" value="{{ $competitor->id }}"></td>
                                @endif
                                <td>{{ $k+1 }}</td>
                                <td>{{ $competitor->fio }}</td>
                                <td>{{ $competitor->point }}</td>
                                <td>{{ $competitor->kata??'-' }}</td>
                                @if ($currentRound==$round)
                                    <td>
                                        @if($competitor->point>0)
                                            Выступил
                                        @else
                                            @if ($competitor->is_current)
                                                Выступает
                                            @else
                                                <a href="{{ route('nextCompetitor', ['id'=>$competitor->id]) }}"
                                                   class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-star"></span>Старт</a>
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                @foreach($users as $user)
                                    @foreach($user->typePoints as $typePoint)
                                        <td>{{ $competitor->list_point[$user->id][$typePoint->id]??0}}</td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                    @if ($currentRound==$round)
                        <button class="btn btn-primary">Исключить участников</button>
                    @endif
                </form>
                @endforeach
                @if ($currentRound==$round)
                    <a href="{{ route('endround') }}" class="btn btn-primary">Раунд окончен</a>
                    <a href="{{ route('nextround') }}" class="btn btn-primary">Следующий раунд</a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
