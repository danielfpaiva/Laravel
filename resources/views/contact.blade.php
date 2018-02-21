{{--<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Contact Page</div>
    </div>
</div>
</body>
</html>--}}
@extends('layouts.app')


@section('content')

    <h1>Contact Page</h1>

    <ul>
        @if(count($people))
            @foreach($people as $person)
                <li>{{$person}}</li>

            @endforeach
        @endif
    </ul>
@stop

@section('footer')

    {{--<script>alert ('Hello world')</script>--}}

@stop