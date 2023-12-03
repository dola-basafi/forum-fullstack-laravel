@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Create By</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)              
          <tr>
            <th scope="row">1</th>
            <td>{{ $item->title }}</td>
            <td>{{ $item->user->name }}</td>
            <td>
              <a href="{{ route('postDetail',$item->id) }}" class="btn btn-info">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
