@extends('viewAdmin.navigation')
@section('title', 'Admin Login')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/login_admin.css') }}">
<div class="login-container">
    <h1>Admin Login</h1>
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit" class="btn-login">Login</button>
    </form>
</div>