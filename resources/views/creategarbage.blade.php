@extends('app')

@section('content')

<div class="main">
    
    <div class="card push-top">
        <a class="no-style" href="{{ route('collections.index') }}">
            <img src="{{ asset('images/home.svg') }}"> Home
        </a>
        <div class="card-header">
            Which garbage type(s) do you want to add? At least one is needed for the app to work.
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
            <form method="POST" action="{{route('garbagetype.store')}}">
                @csrf
                @foreach ($standard_types as $standard_type)
                    <div class="form-check">
                        <input class="form-check-input" 
                                type="checkbox" 
                                name="garbagetypes[]" 
                                value="{{ $standard_type }}" 
                                id="{{ $standard_type }}"
                                @if (in_array(strtolower($standard_type), $existing_types, true))
                                    disabled     
                                @endif  
                                >
                        <label class="form-check-label" for="{{ $standard_type }}">
                            {{ ucfirst($standard_type) }}
                        </label>
                    </div>
                    
                @endforeach
                
                <div class="mb-3 garbage-type-custom-input">
                    <input type="text" 
                        class="form-control"
                        name="garbagetypes[]"
                        id="custom"
                        aria-describedby="customHelp"
                        placeholder="Something, something else, another thing">
                    <div id="customHelp" class="form-text">If adding more than value, separate entries with a comma.</div>
                </div>
                
                <div class="buttons-line">
                    

                    <a href="{{ route('garbagetype.index') }}" class="middle-button">
                        <button type="button" class="btn btn-block btn-danger">Edit Existing Types</button>
                    </a>

                    <a href="{{ URL::previous() }}" class="middle-button">
                        <button type="button" class="btn btn-block btn-secondary">Back</button>
                    </a>

                    <a href="{{ route('collections.create') }}">
                        <button type="button" class="btn btn-block btn-warning">Skip</button>
                    </a>

                    <button type="submit" class="btn btn-block btn-primary right-button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection