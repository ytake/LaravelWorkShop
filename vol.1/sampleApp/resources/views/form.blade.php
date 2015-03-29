@extends('layouts.default')
@section('content')
    <form method="POST" action="{{action('HomeController@postConfirm')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{$errors->first('name')}}
        <input type="text" name="name" id="name" value="{{Input::old('name')}}">
        <button type="submit">confirm</button>
    </form>
@stop
