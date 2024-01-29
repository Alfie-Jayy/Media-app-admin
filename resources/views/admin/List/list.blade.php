@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-8 col-4 mt-3">
                    {{-- alert start --}}
                    @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('deleteSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- alert end --}}
                </div>
                <div class="col-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin List</h3>

                            <div class="card-tools">
                                <form method="get">
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
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>
                                                @if (Auth::user()->id !== $user->id)
                                                    <a href="{{ route('admin#delete', $user->id) }}"><button
                                                            class="btn btn-sm btn-outline-danger"><i
                                                                class="fas fa-trash-alt"></i></button></a>
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
