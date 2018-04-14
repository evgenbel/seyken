@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.competition.new') }}" class="btn btn-primary">Новое</a>
            </div>
            <br/>
            <label>Список соревнований</label>
            <table class="table">
                <tr>
                    <td>Наименование</td>
                    <td>Начало</td>
                    <td>Окончание</td>
                    <td>Текущий раунд</td>
                    <td>Редактировать</td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($competitions as $competition)
                    <tr class="@if($competition->end->format('Ymd')<date('Ymd')) old @else @if($competition->start->format('Ymd')>date('Ymd')) future @else current @endif @endif">
                        <td>{{ $competition->name }}</td>
                        <td>{{ $competition->start->format('d.m.Y') }}</td>
                        <td>{{ $competition->end->format('d.m.Y') }}</td>
                        <td>{{ $competition->round }}</td>
                        <td><a href="{{ route('admin.competition.edit', ['id'=>$competition->id]) }}">Редактировать</a></td>
                        <td><a href="{{ route('admin.competition.next', ['id'=>$competition->id]) }}">Следующий раунд</a></td>
                        <td><a href="{{ route('admin.competition.prev', ['id'=>$competition->id]) }}">Предыдущий раунд</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $competitions->links() }}
        </div>
    </div>
</div>
@endsection
