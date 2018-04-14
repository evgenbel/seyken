@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{ route('admin.kate.new') }}" class="btn btn-primary">Новое</a>
            </div>
            <br/>
            <label>Список кат</label>
            <table class="table">
                <tr>
                    <td>Наименование</td>
                    <td>коэффициент</td>
                </tr>
                @foreach($kates as $kate)
                    <tr>
                        <td>{{ $kate->name }}</td>
                        <td>{{ $kate->koef }}</td>
                        <td><a href="{{ route('admin.kate.edit', ['id'=>$kate->id]) }}">Редактировать</a></td>
                    </tr>
                @endforeach
            </table>

            {{ $kates->links() }}
        </div>
    </div>
</div>
@endsection
