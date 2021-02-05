@extends('app')

@section('content')

<div class="main">
    <div class="card push-top">
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
            <form method="POST" action="{{route('garbage_type.store')}}">
                @csrf
                @foreach ($standard_types as $standard_type)

                    <div class="form-check">
                        <input class="form-check-input" 
                                type="checkbox" 
                                name="garbage_types[]" 
                                value="{{ $standard_type }}" 
                                id="{{ $standard_type }}"
                                @if (in_array(strtolower($standard_type), $existing_types))
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
                        name="garbage_types[]"
                        id="custom"
                        aria-describedby="customHelp"
                        placeholder="Something, something else, another thing">
                    <div id="customHelp" class="form-text">If adding more than value, separate entries with a comma.</div>
                </div>


                <!--
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="glass" id="glass">
                    <label class="form-check-label" for="glass">
                        Glass
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="plastic" id="plastic">
                    <label class="form-check-label" for="plastic">
                        Plastic
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="organic" id="organic">
                    <label class="form-check-label" for="organic">
                        Organic
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="metal" id="metal">
                    <label class="form-check-label" for="metal">
                        Metal
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="paper" id="paper">
                    <label class="form-check-label" for="paper">
                        Paper
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="garbage_types[]" value="batteries" id="batteries">
                    <label class="form-check-label" for="batteries">
                        Batteries
                    </label>
                </div>
                <div class="mb-3 garbage-type-custom-input">
                    <input type="text" 
                        class="form-control"
                        name="garbage_types[]"
                        id="custom"
                        aria-describedby="customHelp"
                        placeholder="Something, something else, another thing">
                    <div id="customHelp" class="form-text">If adding more than value, separate entries with a comma.</div>
                </div>-->
                <div class="buttons-line">
                    <button type="submit" class="btn btn-block btn-primary">Add</button>

                    <a href="{{ route('garbage_type.index') }}" class="edit-button">
                        <button type="button" class="btn btn-block btn-danger">Edit Existing Types</button>
                    </a>

                    <a href="{{ route('collections.create') }}" class="skip-button">
                        <button type="button" class="btn btn-block btn-secondary">Skip</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection