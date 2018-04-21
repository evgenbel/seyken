@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.group.new') }}" class="btn btn-primary">Новое</a>
            </div>
            <br/>
            <label>Список кат</label>
            <table class="table">
                <tr>
                    <td>Наименование</td>
                    <td></td>
                </tr>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td><a href="{{ route('admin.group.edit', ['id'=>$group->id]) }}">Редактировать</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $groups->links() }}
        </div>
    </div>
</div>
@endsection
