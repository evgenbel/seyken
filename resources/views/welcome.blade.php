@extends('layouts.clear')


@section('point_form')

    @if (Auth::check())
        <form>
            @csrf
            @foreach(Auth::user()->typePoints as $type)

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="point_{{ $type->id }}">{{ $type->name }}</label>
                    <input class="slider" id="point_{{ $type->id }}" name="point[{{ $type->id }}]" type="number" min="0"
                           max="1"/>
                </div>
            @endforeach

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </div>
        </form>
    @endif

@endsection

@section('content')
    @if(isset($competition))
    {{--<competition-component--}}
            {{--:competition='{{ $competition }}' :cid="{{ Auth::user()->is_admin?Auth::user()->id:0 }}"></competition-component>--}}
    @else
        <div class="container">
            <div class="justify-content-center">
                <div class="card-header alert">Соревнования не начались</div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="justify-content-center">

            @if(isset($competition))
                <h1>
                    {{ $competition->name }}
                </h1>
                <h3>Проводится с {{ $competition->start }} по {{ $competition->end }}</h3>
                @if($competition->round>0)
                    <competition-round label="{{ __('Round') }}" round="{{ $competition->round }}"></competition-round>
                    {{--<div class="alert alert-primary" id="round-field">--}}
                        {{--Раунд {{ $competition->round }}--}}
                    {{--</div>--}}
                    <div class="block">
                        @forelse($competition->currentCompetitor as $c)
                            <div id="result-block">
                                <competition-info
                                        :user='{{ $c->user }}'
                                        :c='{{ $c }}'
                                        :point="{{ $point }}"
                                ></competition-info>

                                {{--<div class="alert alert-primary" role="alert">--}}
                                    {{--Выступает боец:--}}
                                    {{--{{ $c->user->fio }}--}}
                                    {{--{{ $c->user->date_birth->format("Y")}} г.р.--}}
                                    {{--<br/>Вес: {{ $c->weight }} кг.--}}

                                    {{--<span v-if="$c->kate_id"><br/>Ката: {{ $c->kata->name }}</span>--}}


                                    {{--<div class="h2 text-danger">Общий балл {{ $point }}</div>--}}
                                {{--</div>--}}

                                @guest
                                    <table-result></table-result>
                                    <round-table></round-table>
                                    {{--<table class="table">--}}
                                        {{--<tr>--}}
                                            {{--@foreach($result as $point)--}}
                                                {{--<th>{{ $point->name }}</th>--}}
                                            {{--@endforeach--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--@foreach($result as $point)--}}
                                                {{--<td>{{ number_format($point->point, 2) }}</td>--}}
                                            {{--@endforeach--}}
                                        {{--</tr>--}}
                                    {{--</table>--}}
                                @endguest
                            </div>

                            @guest

                            @else
                                @if(!Auth::user()->is_admin && !$point_sended)
                                    <div id="points-set">
                                        @include('forms.kata', ['kates' => $competition->kates, 'cc'=>$c])

                                        @include('forms.point', ['cc'=>$c])

                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            @endguest
                        @empty
                            @include('result.list', ['competition'=>$competition])
                        @endforelse
                    </div>
                @else
                    <div class="alert alert-primary" role="alert">
                        {{ __('WaitStart') }}
                    </div>
                @endif
            @else
                <div class="card-header">Соревнования не начались</div>
            @endif
        </div>
    </div>
@endsection