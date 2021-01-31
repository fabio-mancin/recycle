@extends('app')

@section('content')

  <div class="main">
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
              <tr>
                  <td>{{'$day->name'}}</td>
                  <td>SOMETHING</td>
                  <td>SOMETIME</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      <form action="{{route('days.create')}}">
          <button class="btn btn-warning" type="submit">Setup</button>
      </form>
  </div>
@endsection
