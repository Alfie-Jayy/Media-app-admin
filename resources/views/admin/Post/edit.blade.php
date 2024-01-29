@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- alert start --}}
                <div class="offset-sm-7 col-sm-5 mt-2">
                    @if (session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('updateSuccess') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                {{-- alert end --}}
                <div class="col-sm-5 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 font-weight-bold">Edit {{ $post->title }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin#postUpdate', $post->post_id)}}" method="post" enctype="multipart/form-data">
                                @csrf

                                @if ($post->image)
                                    <div class="mb-3">
                                        <img class="w-50" src="{{ asset('storage/' . $post->image) }}" alt="">
                                    </div>
                                    <div class="mb-4">
                                        <a href="{{ route('admin#deletePhoto', $post->post_id) }}">
                                            <p class="text-danger font-weight-bold">Delete Photo</p>
                                        </a>
                                    </div>
                                @else
                                <div class="mb-3">
                                    <label for="postImage" class="form-label">Post Image</label>
                                    <input type="file" name="postImage" id="postImage" class="form-control-file">
                                    @error('postImage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                <div class="mb-3">
                                    <label for="postCategory" class="form-label">Category</label>
                                    <select name="postCategory" id="postCategory" class="form-control">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->category_id }}"
                                                {{ $post->category_id == $c->category_id ? 'selected' : '' }}>
                                                {{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('postCategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="postName" class="form-label">Post Title</label>
                                    <input type="text" name="postName" value="{{ old('postName', $post->title) }}"
                                        id="postName" class="form-control">
                                    @error('postName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="postDescription" class="form-label">Description</label>
                                    <textarea name="postDescription" id="postDescription" cols="30" rows="10" class="form-control">{{ old('postDescription', $post->description) }}</textarea>
                                    @error('postDescription')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-sm btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{route('admin#createPost')}}"><button class="btn btn-sm btn-outline-dark">Add
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
                                    @foreach ($posts as $p)
                                        <tr>
                                            <td>{{ $p->post_id }}</td>
                                            <td>{{ $p->category_title }}</td>
                                            <td>
                                                @if ($p->image)
                                                    <div class="">
                                                        <img class="w-100" src="{{ asset('storage/' . $p->image) }}"
                                                            alt="">
                                                    </div>
                                                @else
                                                    <div>
                                                        <img class="w-100"
                                                            src="{{ asset('storage/Image_not_available.png') }}"
                                                            alt="unavailable">
                                                    </div>
                                                @endif
                                            </td>
                                            <td> <a href="{{route('admin#postDetails', $p->post_id)}}" class="text-info">{{ Str::words($p->title, 4, ' ...') }}</a> </td>
                                            <td>{{ Str::words($p->description, 4, '...') }}</td>
                                            <td>{{ $p->created_at->format('M-d-Y') }}</td>
                                            <td>
                                                @if ($post->post_id !== $p->post_id)
                                                <a href="{{ route('admin#editPost', $p->post_id) }}">
                                                    <button class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('admin#deletePost', $p->post_id) }}">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </a>
                                                @else
                                                @endif
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
