@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{ $data->title }} <span class="float-end fs-6"> created at {{ $data->created_at }}</span>
        </h3>
        <h6 class="card-subtitle">Create by <strong>{{ $data->user->name }}</strong> </h6>
        <p class="card-text">{{ $data->body }} <span class="float-end">Category <strong>{{ $data->category->name }}</strong></span></p>
        

        @auth
          <a href="{{ route('like', ['id' => $data->id, 'like' => 1]) }}" class="card-link "><i
              class="bi bi-hand-thumbs-up me-1"></i>like</a>
        @endauth
        @guest
          <i class="bi bi-hand-thumbs-up"></i>
        @endguest
        <span class="ms-1 me-2">{{ $data->likes_count }}</span>
        @auth
          <a href="{{ route('like', ['id' => $data->id, 'like' => 2]) }}" class="card-link"><i
              class="bi bi-hand-thumbs-down me-1"></i>dislike</a>

        @endauth
        @guest
          <i class="bi bi-hand-thumbs-down"></i>
        @endguest
        <span class="ms-1">{{ $data->dislikes_count }}</span>
        @auth
        @if ($data->reportStatus)
            <p class="float-end"><i class="bi bi-flag me-1"></i>report</p>
        @else
        <button  type="button" class="btn  float-end" data-bs-toggle="modal" data-bs-target="#reportModal">
          <span><i class="bi bi-flag me-1"></i>report</span>
        </button>
        {{-- <a href="{{ route('setReport',$data->id) }}" class="float-end"><i class="bi bi-flag me-1"></i>report</a> --}}
        @endif
        @endauth
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
  <div class="container">
    @foreach ($data->comment as $item)
      <div class="card mb-2">
        <div class="card-body">
          <p class="card-text">{{ $item->body }}</p>
          <p class="float-end">create by <strong> {{ $item->user->name }}</strong></p>
          @if (auth()->user()->id == $item->user->id)
            <div>
              <div class="float-start me-2">

                <form action="{{ route('commentDelete', ['idPost' => $data->id, 'idComment' => $item->id]) }}" method="post">
                  @csrf
                  @method('delete')

                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </div>

              <button type="button" onclick="editComment({{ $item->id }},`{{ $item->body }}`)"
                class="btn btn-info " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Update
              </button>
            </div>
          @endif
        </div>
      </div>
    @endforeach
  </div>
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Comment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/" name="formUpdateComment" method="post">
            @csrf
            <div class="form-floating">
              <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Leave a comment here" id="updatecomment"
                name="body"></textarea>
              @error('body')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              <label for="floatingTextarea">Comments</label>
              <button class="btn btn-primary mt-2">Update</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal report-->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Alasan Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('setReport',$data->id) }}" name="formReport" method="post">
          @csrf
          <div class="form-floating">
            <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Leave a comment here" id="reportcomment"
              name="body"></textarea>
            @error('body')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <label for="floatingTextarea">laporkan</label>
            <button class="btn btn-primary mt-2">Report</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <script>
    function editComment(id, body) {
      let host = window.location.protocol + "//" + window.location.host + `/comment/update/{{ $data->id }}/${id}`;
      document.getElementById("updatecomment").value = body;
      document.formUpdateComment.action = host
    }
    
  </script>
@endsection
