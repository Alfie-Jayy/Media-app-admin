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
                            <h5 class="mb-0 font-weight-bold">Create New Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin#categoryCreateBtn') }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="categoryName" class="form-label">Title</label>
                                    <input type="text" name="categoryName" value="{{ old('categoryName') }}"
                                        id="categoryName" class="form-control">
                                    @error('categoryName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="categoryDescription" class="form-label">Description</label>
                                    <textarea name="categoryDescription" id="categoryDescription" cols="30" rows="10" class="form-control">{{ old('categoryDescription') }}</textarea>
                                    @error('categoryDescription')
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
                                        <input type="text" name="key" value="{{request('key')}}" class="form-control float-right"
                                            placeholder="Search">

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
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_id }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>{{ $category->created_at->format('M-d-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#editCategory', $category->category_id) }}">
                                                    <button class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('admin#deleteCategory', $category->category_id) }}">
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
