@if (Auth::check())
    <form method="post" action="/" novalidate>
        @csrf
        @foreach(Auth::user()->typePoints as $type)

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="point_{{ $type->id }}">{{ $type->name }}</label>
                <input class="slider" id="point_{{ $type->id }}" name="point[{{ $type->id }}]" type="number" min="0"
                       max="10"/>
            </div>
        @endforeach
        <input type="hidden" name="action" value="{{ $cc->id }}"/>
        @if ($cc->kate_id>0)
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">OK</button>
            </div>
        </div>
        @else
            <div class="alert alert-danger" role="alert">
                Не выбран ката
            </div>
        @endif
    </form>
@endif