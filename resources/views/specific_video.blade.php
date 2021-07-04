@extends('master')

@section('stylesheet')
    <style>
        .video-section video{
            width: 100%;
            max-height: 450px;
            background-color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="video-section mb-5">
                    <video src="{{ asset('storage/'.$specific_video->user_video) }}" controls></video>
                    <div class="title-field mt-2">
                        <div class="d-flex justify-content-between">
                            <span class="title">
                                {{ ucfirst($specific_video->title) }}
                            </span>
                            <span class="time">
                                {{ date('d-m-Y h:i:s A', strtotime($specific_video->created_at)) }}
                            </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="comment-section">
                    @auth    
                        <form action="{{ route('comment') }}" method="post">
                            @csrf
                            
                            <input type="hidden" name="vid" value="{{ $specific_video->id }}">
                            <div class="form-group">
                                <input type="text" name="comment" id="comment" placeholder="Add a comment..." class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info">Comment</button>
                        </form>
                    @endauth
                    
                    @if (isset($specific_video->comment) && count($specific_video->comment) > 0)
                        <div class="show-comment mt-5">
                            <h6>Comments</h6>
                            <ul class="list-group">
                                @foreach ($specific_video->comment as $item)
                                    <li class="list-group-item">
                                        {{ $item->comment }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div id="show-videos">
                    @foreach ($videos as $item)
                        <div class="mb-5">
                            <a href="{{ route('specific_video', ['vid' => $item->id]) }}">
                                <video src="{{ asset('storage/'.$item->user_video) }}"></video>
                            </a>
                            <div class="title-field">
                                <div class="d-flex justify-content-between">
                                    <span class="title">
                                        {{ ucfirst($item->title) }}
                                    </span>
                                    <span class="time">
                                        {{ date('d-m-Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection