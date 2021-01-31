@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
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
                                    <select name="garbage_type[]" class="form-select" form="collections-form">
                                        <option selected>Select a garbage type</option>
                                        @foreach ($types as $type)
                                            <option value={{$type->id}}>{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="day[]" class="form-select" form="collections-form">
                                        <option selected>Select a day</option>
                                        @foreach ($days as $day)
                                            <option value={{$day->id}}>{{$day->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" 
                                        class="form-control"
                                        name="collections[]"
                                        form="collections-form"
                                        placeholder="09:00-10:00 // 'Morning'">
                                </td>
                            </tr>
                        </tbody>
                </table>
            <button type="submit" class="btn btn-block btn-danger" form="collections-form">Save</button>
            <button type="button" id="new-row" class="btn btn-block btn-secondary">New Row</button>
        
        </div>
    </div>

    <div id="new-collection-row-template">
        <td>
            <select name="garbage_type[]" class="form-select" form="collections-form">
                <option selected>Select a garbage type</option>
                @foreach ($types as $type)
                    <option value={{$type->id}}>{{$type->type}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="day[]" class="form-select" form="collections-form">
                <option selected>Select a day</option>
                @foreach ($days as $day)
                    <option value={{$day->id}}>{{$day->name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="text" 
                class="form-control"
                name="collections[]"
                form="collections-form"
                placeholder="09:00-10:00 // 'Morning'">
        </td>
    </div>
</div>
@endsection