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
                                    <form class="form-inline-icon" method="POST" action="{{ route('garbage_type.update', [$type->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <input class="form-control" value="{{ ucfirst($type->type) }}" name="garbage_type" placeholder="{{ ucfirst($type->type) }}" />
                                        <button type="submit">
                                            <img src="{{ asset('images/edit.svg') }}">
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form class="form-inline-icon" method="POST" action="{{ route('garbage_type.destroy', [$type->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type=image src="{{ asset('images/x-square.svg') }}" alt="Delete entry">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('garbage_type.create') }}" class="skip-button">
                    <button type="button" class="btn btn-block btn-secondary"> Back </button>
                </a>
        </div>
    </div>
</div>
@endsection