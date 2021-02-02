@extends('app')

@section('content')

  <div class="main">
      <h1> Recycle Collection Recap </h1>
      <div class="filter-day-container">
        <input type="checkbox" id="filter-day" />
        <label for="filter-day" class="ml-1">Show today only.</label>
      </div>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Day</th>
                  <th scope="col">Garbage Type</th>
                  <th scope="col">Collection Time</th>
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
                </tr>
              @endforeach
          </tbody>
      </table>
      <form action="{{route('days.create')}}">
          <button class="btn btn-warning" type="submit">Setup</button>
      </form>
  </div>
@endsection
