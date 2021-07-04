@extends('layouts.app')

@section('stylesheet')
    <style>
        #video{
            display: none;
        }
        .file-holder{
            border: 1px solid rgb(199, 187, 242);
            width: 300px;
            margin-bottom: 0;
            padding-left: 10px;
            line-height: 200%;
            cursor: pointer;
        }
        .is-invalid{
            border: 1px solid #dc3545;
        }
        .invalid-feedback{
            display: block;
        }

        .show-video video{
            width: 600px;
            height: 400px;
            background-color: #000;
        }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Video') }}</div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert-success alert">
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    @endif

                    @if (Session::has('fail'))
                        <div class="alert-danger alert">
                            <span>{{ Session::get('fail') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('video_upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Title</span>
                            </div>
                            <input type="text" name="title" placeholder="Enter title..." class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Category</span>
                            </div>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option disabled selected>Select Category</option>
                                <option value="news">News</option>
                                <option value="movie">Movie</option>
                            </select>
                            
                            @error('category')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-4">
                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror">
                            @error('video')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="show-video">
            <h4>My videos list</h4>
            @foreach (Auth::user()->video as $item)
                <div class="card-body">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span class="text-dark">{{ ucfirst($item->title) }}</span>
                            <span class="text-dark">{{ ucfirst($item->category) }}</span>
                        </div>
                    </div>
                    <video src="{{ asset('storage/'.$item->user_video) }}" controls>
                    </video>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
