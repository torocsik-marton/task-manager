@extends('master')

@section('content')
    <form name="login_form" method="post">
        @csrf

        <label for="">E-mail:</label>
        <input type="text" name="email" placeholder="e-mail" />
        <br/>

        <label for="">Password:</label>
        <input type="password" name="password" placeholder="password" />
        <br/>

        <input type="submit" value="Login" />
    </form>
@stop