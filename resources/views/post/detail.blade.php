@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{ $data->title }}</h3>
        <h6 class="card-subtitle">Create by <strong>{{ $data->user->name }}</strong> </h6>
        <p class="card-text">{{ $data->body }}</p>
        @auth
          <a href="{{ route('like',['id'=>$data->id,'like' =>1]) }}" class="card-link "><i class="bi bi-hand-thumbs-up me-1"></i>like</a>
        @endauth
        @guest
          <i class="bi bi-hand-thumbs-up"></i>
        @endguest
        <span class="ms-1 me-2">{{ $data->likes_count }}</span>
        @auth 
        <a href="{{ route('like',['id'=>$data->id,'like' =>2]) }}" class="card-link"><i class="bi bi-hand-thumbs-down me-1"></i>dislike</a>

        @endauth
        @guest
          <i class="bi bi-hand-thumbs-down"></i>
        @endguest
        <span class="ms-1">{{ $data->dislikes_count }}</span>
        
      </div>
    </div>
    @auth
      <div class="container my-2">
        <form action="{{ route('commentStore', $data->id) }}" method="post">
          @csrf
          <div class="form-floating">
            <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Leave a comment here"
              id="floatingTextarea" name="body"></textarea>
            @error('body')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <label for="floatingTextarea">Comments</label>
            <button class="btn btn-primary mt-2">Send</button>
          </div>
        </form>
      </div>
    </div>

  @endauth
  {{-- @dd($data->comment[0]) --}}
  <div class="container">
    @foreach ($data->comment as $item)
      <div class="card mb-2">
        <div class="card-body">
          <p class="card-text">{{ $item->body }}</p>
          <p class="float-end">create by <strong> {{ $item->user->name }}</strong></p>
        </div>
      </div>
    @endforeach
  </div>
@endsection
