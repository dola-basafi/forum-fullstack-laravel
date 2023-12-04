@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">isi report</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)              
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->body }}</td>            
          </tr>
          @endforeach
        </tbody>
      </table>


      <div class="card">
        <div class="card-body">
          <h3 class="card-title">{{ $post->title }} <span class="float-end fs-6"> created at {{ $post->created_at }}</span>
          </h3>
          <h6 class="card-subtitle">Create by <strong>{{ $post->user->name }}</strong> </h6>
          <p class="card-text">{{ $post->body }}</p>  
          <a href="{{ route('reporConfirm',['idPost'=>$post->id,'idUser' => $post->user_id]) }}" class="btn btn-danger">Delete</a>

        </div>
      </div>
    </div>
  </div>
@endsection
