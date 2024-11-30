@extends('layout')

@section('title', 'Tournament Results')

@section('header', 'Results for Tournament')


@section('content')
    @include('result.results_table', ['results' => $results, 'showActions' => true])
    <a href="{{ url('/tournament/generateReport') }}">Generate report</a>
@endsection
