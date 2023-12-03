@extends('layouts.app')
@section('content')
{{-- @dd($data->category) --}}
  

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Buat Postingan') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('updatePost',$data->id) }}">
              @csrf

              <div class="row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>

                <div class="col-md-6">
                  <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $data->title }}"
                     autocomplete="title" autofocus>

                  @error('title')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="body" class="col-md-4 col-form-label text-md-end">Isi</label>

                <div class="col-md-6">
                  <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ $data->body }}"
                     autocomplete="body" autofocus>

                  @error('body')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="category" class="col-md-4 col-form-label text-md-end">Category</label>
                <div class="col-md-6">
                  <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id">
                   <option value="{{ $data->category->id }}">{{ $data->category->name }}</option>
                    @foreach ($data->Datacategory as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>                      
                    @endforeach
                  </select>
                  @error('category_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>
              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                  </button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection