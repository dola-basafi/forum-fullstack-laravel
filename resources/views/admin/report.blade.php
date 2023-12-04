@extends('layouts.app')
@section('content')
  

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('konfirmasi Delete Post') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('updatePost',$data) }}">
              @csrf             
              <div class="row mb-3">
                <label for="body" class="col-md-4 col-form-label text-md-end">Isi</label>

                <div class="col-md-6">
                  <input id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}"
                     autocomplete="body" autofocus>

                  @error('body')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              
              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Delete') }}
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