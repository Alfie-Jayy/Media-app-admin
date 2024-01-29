@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 offset-3 mt-5">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <legend class="text-center"> Change Password </legend>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    {{-- alert start --}}
                                    @if (session('updateFail'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('updateFail') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    {{-- alert end --}}
                                    <div class="active tab-pane" id="activity">

                                        <form class="form-horizontal" method="POST"
                                            action="{{ route('admin#updatePassword') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="currentPassword" class="col-sm-4 col-form-label">Current
                                                    Password</label>
                                                <div class="col-sm-8">
                                                    <input name="currentPassword" type="password" class="form-control"
                                                        id="currentPassword" placeholder="Enter Current Password">
                                                    @error('currentPassword')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="newPassword" class="col-sm-4 col-form-label">New
                                                    Password</label>
                                                <div class="col-sm-8">
                                                    <input name="newPassword" type="password" class="form-control"
                                                        id="newPassword" placeholder="Enter New Password">
                                                    @error('newPassword')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="confirmPassword" class="col-sm-4 col-form-label">Confirm New
                                                    Password</label>
                                                <div class="col-sm-8">
                                                    <input name="confirmPassword" type="password" class="form-control"
                                                        id="confirmPassword" placeholder="Confirm New Password">
                                                    @error('confirmPassword')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="offset-sm-4 col-sm-8">
                                                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                                                </div>
                                            </div>

                                        </form>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
