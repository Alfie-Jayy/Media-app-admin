@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
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

                                        <th>User ID</th>
                                        <th>Post ID</th>
                                        <th>Post title</th>
                                        <th>Image</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>

                                            <td>{{ $post->user_id }}</td>
                                            <td>{{ $post->post_id }}</td>
                                            <td>
                                                <a href="{{route('admin#postDetails', $post->post_id)}} "
                                                    class="text-info">
                                                    {{ $post->title }}
                                                </a>
                                            </td>
                                            {{-- <td>{{$post->title}}</td> --}}
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
                                            <td>{{ $post->view_count }} views</td>
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
