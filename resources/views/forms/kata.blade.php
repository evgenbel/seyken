@if(Auth::user()->set_kata)
    @if(!$cc->kate_id)
        <div class="alert alert-danger" role="alert">
            Необходимо выбрать какое ката показывается
        </div>
    @endif
    <form method="post" action="{{url('/kata')}}">
        @csrf
        @if($cc->kate_id)
            <input type="hidden" name="kata" value="0"/>
        @else
            @foreach($kates as $kate)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kata" id="kata{{ $kate->id }}"
                           value="{{ $kate->id }}" checked>
                    <label class="form-check-label" for="kata{{ $kate->id }}">
                        {{ $kate->name }} ({{ $kate->koef }})
                    </label>
                </div>
            @endforeach
        @endif
        <input type="hidden" name="action" value="{{ $cc->id }}"/>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">
                    @if($cc->kate_id)
                        Сменить ката
                    @else
                        Выбрать
                    @endif
                </button>
            </div>
        </div>

    </form>
@endif