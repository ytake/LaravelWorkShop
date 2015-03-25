@extends('layouts.default')
@section('content')
    <form method="POST" action="{{action('HomeController@postApply')}}">
        <input type="hidden" name="_token" value="{{Input::get('_token')}}">
        <input type="hidden" name="name" value="{{Input::get('name')}}">
        {{Input::get('name')}}
        <input name="_return" type="submit" value="return">
        <input name="_apply" type="submit" value="apply">
    </form>
@stop
