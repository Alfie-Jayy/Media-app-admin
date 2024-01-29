@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('admin#createPost') }}"><button class="btn btn-sm btn-outline-dark">Add
                                        Post</button></a>
                            </h3>

                            <div class="card-tools">
                                <form action="" method="get">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="key" value="{{ request('key') }}"
                                            class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created_at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->post_id }}</td>
                                            <td>{{ $post->category_title }}</td>
                                            <td>
                                                @if ($post->image)
                                                    <div class="">
                                                        <img style="width: 100px;"
                                                            src="{{ asset('storage/' . $post->image) }}" alt="">
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <img style="width: 100px;"
                                                            src="{{ asset('storage/Image_not_available.png') }}"
                                                            alt="unavailable">
                                                    </div>
                                                @endif
                                            </td>
                                            <td> <a href="{{route('admin#postDetails', $post->post_id)}}" class="text-info">{{ Str::words($post->title, 4, ' ...') }}</a> </td>
                                            <td>{{ Str::words($post->description, 4, ' ...') }}</td>
                                            <td>{{ $post->created_at->format('M-d-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#editPost', $post->post_id) }}">
                                                    <button class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('admin#deletePost', $post->post_id) }}">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </a>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
