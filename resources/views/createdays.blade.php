@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
        <div class="card-header">
            Which day(s) do you want to add to the recycle weekly plan? At least one day needs to be set up in order to
            use the app.
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

                @foreach ($daysInWeek as $n => $day)
                <div class="form-check">
                    <input 
                        class="form-check-input mr-1" 
                        type="checkbox" 
                        name="days[]" 
                    @if (is_array($day))
                        value="{{$day[1] . "-" . $day[0]}}" 
                        id="{{$day[2]}}" 
                        disabled>
                        <label class="form-check-label mr-1" for="{{$day[0]}}">
                            {{ucfirst($day[0])}}
                        </label>
                        <img class="icon" data-dayid="{{$day[2]}}" src="{{asset('images/x-square.svg')}}">
                    @else
                        value="{{$n . "-" . $day}}"
                        id="{{$day}}">
                        <label class="form-check-label mr-1" for="{{$day}}">
                            {{ucfirst($day)}}
                        </label>
                    @endif
                </div>

                @endforeach

                <button type="submit" class="btn btn-block btn-danger">Add</button>
                <a href="{{route('garbage_type.create')}}" class="skip-button">
                    <button type="button" class="btn btn-block btn-secondary">Skip</button>
                </a>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalLabel"> Are you sure you want to delete the selected item?
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You cannot revert this change.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="delete-link" class="btn btn-danger"> Delete </button></a>
            </div>
        </div>
    </div>
</div>
@endsection
