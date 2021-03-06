@extends('app')

@section('content')

<div class="main">
    
    <div class="card push-top">
        <a class="no-style" href="{{ route('collections.index') }}">
            <img src="{{ asset('images/home.svg') }}"> <span class="fw-bold">Home</span>
        </a>
        <div class="card-header">
            Choose the day and time for recycling garbage collection.
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
            <form method="POST" action="{{route('collections.store')}}" id="collections-form">@csrf</form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Garbage Type</th>
                            <th scope="col">Day</th>
                            <th scope="col">Collection Time</th>
                        </tr>
                    </thead>
                        <tbody id="collection-table-body">
                            <tr class="new-collection-row">
                                <td>
                                    <select name="collections[]" class="form-select" form="collections-form" required>
                                        <option selected>Select a garbage type</option>
                                        @foreach ($types as $type)
                                            <option value={{ $type->id }}>{{ ucfirst($type->type) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="collections[]" class="form-select" form="collections-form" required>
                                        <option selected>Select a day</option>
                                        @foreach ($days as $day)
                                            <option value={{ $day->id }}>{{ ucfirst($day->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" 
                                        class="form-control"
                                        name="collections[]"
                                        form="collections-form"
                                        placeholder="09:00-10:00 // 'Morning'"
                                        required>
                                </td>
                            </tr>
                        </tbody>
                </table>

            <div class="buttons-line">
                <button type="submit" class="btn btn-block btn-danger" form="collections-form">Save</button>

                <button type="button" id="new-row" class="btn btn-block btn-info middle-button">New Row</button>

                <a href="{{ route('garbagetype.create') }}" class="middle-button">
                    <button type="button" class="btn btn-block btn-secondary">Back</button>
                </a>
                
                <a href="{{ route('collections.index') }}" class="right-button">
                    <button type="button" class="btn btn-block btn-warning">Skip</button>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection