@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
        <div class="card-header">
            Which day(s) do you want to add to the recycle weekly plan? At least one day needs to be set up in order to use the app.
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="POST" action="{{route('days.store')}}">
                @csrf
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="1-monday" id="monday">
                    <label class="form-check-label" for="monday">
                        Monday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="2-tuesday" id="tuesday">
                    <label class="form-check-label" for="tuesday">
                        Tuesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="3-wednesday" id="wednesday">
                    <label class="form-check-label" for="wednesday">
                    Wednesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="4-thursday" id="thursday">
                    <label class="form-check-label" for="thursday">
                    Thursday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="5-friday" id="friday">
                    <label class="form-check-label" for="friday">
                    Friday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="6-saturday" id="saturday">
                    <label class="form-check-label" for="saturday">
                    Saturday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="7-sunday" id="sunday">
                    <label class="form-check-label" for="sunday">
                    Sunday
                    </label>
                </div>
                <button type="submit" class="btn btn-block btn-danger">Add</button>
                <a href="{{route('garbage_type.create')}}">
                    <button type="button" class="btn btn-block btn-secondary">Skip</button>
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
