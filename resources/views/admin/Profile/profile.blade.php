@extends('admin.Layout.app')

@section('myContent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 offset-3 mt-5">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <legend class="text-center"> {{Auth::user()->name}}'s Profile</legend>
                            </div>
                            {{-- alert start --}}
                            @if (session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('updateSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">

                                        <form class="form-horizontal" method="POST"
                                            action="{{ route('admin#profileUpdateBtn') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input name="name" type="name" class="form-control" id="inputName"
                                                        placeholder="Name" value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input name="email" type="email" class="form-control"
                                                        id="inputEmail" placeholder="Email"
                                                        value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input name="phone" type="text" class="form-control"
                                                        id="inputPhone" placeholder="Phone number"
                                                        value="{{ $user->phone }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <select name="gender" id="inputGender" class="form-control">
                                                        <option @if ($user->gender == 'null') selected @endif
                                                            value="null">Select Gender</option>
                                                        <option @if ($user->gender == 'male') selected @endif
                                                            value="male">Male</option>
                                                        <option @if ($user->gender == 'female') selected @endif
                                                            value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10">
                                                    <textarea name="address" class="form-control" rows="5" id="inputAddress" placeholder="address">{{ $user->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn bg-dark text-white">Update</button>
                                                </div>
                                            </div>

                                        </form>


                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <a href="{{route('admin#changePassword')}}">Change Password</a>
                                            </div>
                                        </div>

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
