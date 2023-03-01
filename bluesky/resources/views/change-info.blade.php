@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->get('message'))
            <div class="alert alert-success" role="alert">
                <strong>Success: </strong>{{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->name }}'s Profile</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <form action="{{ route('change-info') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email"><strong>Email:</strong></label>
                                <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                <input name="old_password" type="password"
                                    class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control"
                                    id="confirmNewPasswordInput" placeholder="Confirm New Password">
                            </div>
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
