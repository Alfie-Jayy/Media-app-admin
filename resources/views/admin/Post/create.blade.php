@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- alert start --}}
                <div class="offset-sm-7 col-sm-5 mt-2">
                    @if (session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('createSuccess') }}</span>
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
                            <h5 class="mb-0 font-weight-bold">Create New Post</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin#postCreateBtn') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="postImage" class="form-label">Post Image</label>
                                    <input type="file" name="postImage" id="postImage" class="form-control-file">
                                    @error('postImage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="postCategory" class="form-label">Category</label>
                                    <select name="postCategory" id="postCategory" class="form-control">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->category_id }}"
                                                {{ old('postCategory') == $c->category_id ? 'selected' : '' }}>
                                                {{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('postCategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="postName" class="form-label">Post Title</label>
                                    <input type="text" name="postName" value="{{ old('postName') }}" id="postName"
                                        class="form-control">
                                    @error('postName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="postDescription" class="form-label">Description</label>
                                    <textarea name="postDescription" id="postDescription" cols="30" rows="10" class="form-control">{{ old('postDescription') }}</textarea>
                                    @error('postDescription')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-sm btn-success" type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mt-2">
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
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Title</th>
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
                                                        <img class="w-100" src="{{ asset('storage/' . $post->image) }}"
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
                                            <td> <a href="{{route('admin#postDetails', $post->post_id)}}" class="text-info">{{ Str::words($post->title, 4, ' ...') }}</a> </td>
                                            <td>{{ $post->created_at->format('M-d-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#editPost', $post->post_id )}}">
                                                    <button class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('admin#deletePost', $post->post_id) }}">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </a>
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
