@extends('app')

@section('content')

  <div class="main">
      <h1> Recycle Collection Recap </h1>
      <div class="filter-day-container">
        <input type="checkbox" id="filter-day" />
        <label for="filter-day">Show today only.</label>
      </div>
      <table class="table">
          <thead>
                <tr>                 
                    <th scope="col">
                        <a href="{{ route('days.create') }}" class="no-style">Day</a>
                    </th>                       
                    <th scope="col">
                        <a href="{{ route('garbagetype.create') }}" class="no-style">Garbage Type</a>
                    </th>
                    <th scope="col">
                        <a href="{{ route('collections.create') }}" class="no-style">Collection Time</a>
                    </th>
                    <th scope="col">Delete</th>
                </tr>
          </thead>
          <tbody>
                <tr>
                    <td><input type="text" class="form-control filter-collections" data-col="day" placeholder="Filter days"/></td>
                    <td><input type="text" class="form-control filter-collections" data-col="type" placeholder="Filter types"/></td>
                    <td><input type="text" class="form-control filter-collections" data-col="time" placeholder="Filter times"/></td>
                </tr>
              @foreach ($collections as $collection)
                <tr class="day-row" data-number-in-week="{{$collection->number_in_week}}">
                    <td class="collection-day" data-col="day" >{{$collection->day}}</td>
                    <td class="collection-type" data-col="type" >{{$collection->type}}</td>
                    <td class="collection-time" data-col="time" >{{$collection->time}}</td>
                    <td>
                        <form class="form-inline-icon" method="POST" action="{{ route('collections.destroy', $collection->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('images/x-square.svg') }}">
                            </button>
                        </form>
                    </td>
                </tr>
              @endforeach
          </tbody>
      </table>
      <form action="{{route('days.create')}}">
          <button class="btn btn-warning" type="submit">Setup</button>
      </form>
  </div>
@endsection
