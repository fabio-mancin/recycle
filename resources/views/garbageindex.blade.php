@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
        <div class="card-header">
            Edit or delete garbage types. 
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
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($garbage_types as $type)
                            <tr class="mb-3">
                                <td>
                                    <form method="POST" action="{{route('garbage_type.store')}}">
                                        @csrf
                                        @method('PUT')
                                        <input class="form-control" value="{{$type->type}}" placeholder="{{$type->type}}" />
                                        <img class="icon" src="{{asset('images/edit.svg')}}">
                                    </form>
                                </td>
                                <td class="text-center">
                                    <img class="icon" src="{{asset('images/x-square.svg')}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection