@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
        <a class="no-style" href="{{ route('collections.index') }}">
            <img src="{{ asset('images/home.svg') }}"> <span class="fw-bold">Home</span>
        </a>
        <div class="card-header">
            
            Which day(s) do you want to add to the recycle weekly plan?
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
            <form method="POST" action="{{route('days.store')}}" id="days-form">@csrf</form>
            <table class="table">
                <thead>
                    <tr>
                        <th> </th>
                        <th> Day </th>
                        <th> Delete </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standard_days as $standard_day)
                        @php ($day_exists = in_array(strtolower($standard_day), $existing_names))
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input mr-1" 
                                        type="checkbox" 
                                        name="days[]"
                                        form="days-form" 
                                        value="{{ $standard_day }}" 
                                        id="{{ $standard_day }}" 
                                        @if ($day_exists) disabled @endif
                                    >
                                </div>
                            </td>
                            <td>
                                <label class="form-check-label mr-1" for="{{ $standard_day }}">
                                    {{ ucfirst($standard_day) }}
                                </label> 
                            </td>
                            <td>
                                @if ($day_exists)
                                @php ($id = $existing_days->where('name', $standard_day)->first()->id)
                                    <form class="form-inline-icon" method="POST" action="{{ route('days.destroy', $id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <img src="{{ asset('images/x-square.svg') }}">
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="buttons-line">
                <a href="{{ route('garbagetype.create') }}">
                    <button type="button" class="btn btn-block btn-warning">Skip</button>
                </a>

                <a href="{{ route('collections.index') }}" class="middle-button">
                    <button type="button" class="btn btn-block btn-secondary">Back</button>
                </a>
                <button type="submit" class="btn btn-block btn-primary right-button" form="days-form">Save</button>
            </div>
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
