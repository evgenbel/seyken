@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.competitor.new') }}" class="btn btn-primary">Новое</a>
            </div>
            <br/>
            <label>Список участников</label>
            <table class="table">
                <tr>
                    <td>ФИО</td>
                    <td>Категория</td>
                    <td>Город</td>
                    <td>Школа</td>
                    <td>Дата рождения</td>
                    <td>Вес</td>
                    <td></td>
                </tr>
                @foreach($competitors as $competitor)
                    <tr>
                        <td>{{ $competitor->fio }}</td>
                        <td>{{ $competitor->group->name??'' }}</td>
                        <td>{{ $competitor->city }}</td>
                        <td>{{ $competitor->school }}</td>
                        <td>{{ $competitor->date_birth->format('d.m.Y') }}</td>
                        <td>{{ $competitor->weight }}</td>
                        <td><a href="{{ route('admin.competitor.edit', ['id'=>$competitor->id]) }}">Редактировать</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $competitors->links() }}
        </div>
    </div>
</div>
@endsection
