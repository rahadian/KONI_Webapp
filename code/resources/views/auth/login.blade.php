@extends('layouts.app')

@section('content')
    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
    @csrf
     @if (session('status'))
        <div class="alert alert-success">
            <b><font size="4">{{session('status')}}</font></b>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <strong><font size="4">{{ $message }}</font></strong>
        </div>
    @endif
        <h2 class="sr-only">Login Form</h2>
        <center><p>APP KONI KAB PROBOLINGGO</p></center>
        <div class="illustration"><i class="icon ion-ios-locked-outline"></i>

        </div>
        <div class="form-group"><input class="form-control" type="username" name="username" placeholder="Username">
        </div>
        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
    </form>

@endsection
