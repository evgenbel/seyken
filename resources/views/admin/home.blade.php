@extends('layouts.app')

@section('content')
    <div class="container1">
        <div class="row justify-content-center">
            @foreach($list as $round=>$competitors)
                <h3>Раунд {{ $round }}</h3>
                <form method="post" action="{{ route('startround') }}">
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
                        @foreach($competitors as $k=>$competitor)
                            @if($competitor->disabled_round>0 && $competitor->disabled_round<$round)
                                @continue;
                            @endif
                            <tr @if($competitor->is_current && $currentRound==$round) class="current" @endif>
                                @if ($currentRound==$round)
                                    <td><input type="checkbox" name="exclude[]" value="{{ $competitor->id }}"></td>
                                @endif
                                <td>{{ $k }}</td>
                                <td>{{ $competitor->user->fio }}</td>
                                <td>{{ $competitor->point }}</td>
                                <td>{{ $competitor->kata->name??'-' }}</td>
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
                        <a href="{{ route('endround') }}" class="btn btn-primary">Итоговая таблица зрителям</a>
                        <button class="btn btn-primary">Исключить и начать следующий раунд</button>
                    @endif
                </form>
            @endforeach
        </div>
    </div>
@endsection