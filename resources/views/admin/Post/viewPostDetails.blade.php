@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">

            <div class="">
                <div class="mt-3 p-3">

                    <div class="p-5">
                        <div>
                            <a onclick="history.back()" style="cursor: pointer"><i
                                    class="fa-solid fa-angles-left fa-lg text-dark"></i></a>
                        </div>
                        <div class="text-center">

                            @if ($post->image)
                                <div>
                                    <img class="mb-5" style="width: 500px;" src="{{ asset('storage/' . $post->image) }}" alt="">
                                </div>
                            @else
                                <div>
                                    <img class="mb-5" style="width: 500px;" src="{{ asset('storage/Image_not_available.png') }}"
                                        alt="unavailable">
                                </div>
                            @endif

                        </div>
                        <div class="mb-3">
                            <h3 class="mb-3">{{ $post->title }}</h3>
                            <p>Post ID - {{ $post->post_id }}</p>
                            <p>Category - {{ $post->category_name }}</p>
                        </div>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </div>

        </div>
    @endsection
