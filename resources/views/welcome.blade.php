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
                <h3>Проводится с {{ $competition->start->format('d.m.Y')}} по {{ $competition->end->format('d.m.Y') }}</h3>
                @if($competition->round>0)
                    <competition-round label="{{ __('Round') }}" round="{{ $competition->round }}"
                                       group="{{ $competition->group->name??'' }}"></competition-round>
                    <div class="block">
                        @guest

                        @else
                            <h2>Судья {{ Auth::user()->name }}</h2>
                        @endguest

                        @if($competitor)
                            <div id="result-block">
                                <competition-info
                                        :c='{{ $competitor }}'
                                        :point="{{ $point }}"
                                        :itog="{{ $sum }}"
                                ></competition-info>

                                @guest
                                    <table-result></table-result>
                                @endguest
                            </div>

                            @guest

                            @else
                                @if(!Auth::user()->is_admin && $point_sended)
                                    <div id="points-set">
                                        @if(Auth::user()->set_kata)
                                            <kata
                                            url="{{url('/kata')}}"
                                            :kates="{{$competition->kates}}"
                                            :c="{{$competitor}}"
                                            ></kata>
                                        @endif
                                        {{--@include('forms.kata', ['kates' => $competition->kates, 'cc'=>$competitor])--}}

                                        @include('forms.point', ['cc'=>$competitor])

                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            @endguest
                        @else
                            @include('result.list', ['competition'=>$competition])
                        @endif

                        @guest
                                <round-table></round-table>
                        @endguest
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