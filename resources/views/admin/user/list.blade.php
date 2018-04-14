@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.user.new') }}" class="btn btn-primary">Новое</a>
            </div>
            <br/>
            <label>Список кат</label>
            <table class="table">
                <tr>
                    <td>Наименование</td>
                    <td>email</td>
                    <td>Выбирает каты</td>
                    <td></td>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->set_kata?'Да':'Нет' }}</td>
                        <td><a href="{{ route('admin.user.edit', ['id'=>$user->id]) }}">Редактировать</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
