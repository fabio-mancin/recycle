@extends('app')

@section('content')

  <div class="main">
      <h1> Recycle Collection Recap </h1>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Day</th>
                  <th scope="col">Garbage Type</th>
                  <th scope="col">Collection Time</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($collections as $collection)
                <tr class="day-row" data-number-in-week="{{$collection->number_in_week}}">
                    <td>{{$collection->day}}</td>
                    <td>{{$collection->type}}</td>
                    <td>{{$collection->time}}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
      <div class="filter-day-container">
        <input type="checkbox" id="filter-day" />
        <label for="filter-day" class="ml-1">Show today only.</label>
      </div>
      <form action="{{route('days.create')}}">
          <button class="btn btn-warning" type="submit">Setup</button>
      </form>
  </div>
@endsection
