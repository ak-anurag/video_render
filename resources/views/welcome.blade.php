@extends('master')
        

@section('content')
    <section class="container mt-5" id="show-videos"> 
        <h3>
            <select name="category" id="category">
                <option value="news">News</option>
                <option value="movie">Movie</option>
            </select>
        </h3>

        <div class="row">

            @foreach ($videos as $item)
                <div class="col-12 col-sm-2 col-md-3 col-lg-4 mb-5">
                    <a href="{{ route('specific_video', ['vid' => $item->id]) }}">
                        <video src="{{ asset('storage/'.$item->user_video) }}"></video>
                    </a>
                    <div class="title-field mt-2">
                        <div class="d-flex justify-content-between">
                            <span class="title">
                                {{ ucfirst($item->title) }}
                            </span>
                            <span class="time">
                                {{ date('d-m-Y h:i:s A') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
