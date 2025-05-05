@extends('layouts.app')

@section('title', 'ILLEGALACT | HOME')

@section('content')
    @include('sections.home.hero', ['slides' => $slides])
    @include('sections.home.about')
    @include('sections.home.banner1')
    @include('sections.home.releases', ['releases' => $releases])
    @include('sections.home.events', ['events' => $events])
@endsection
