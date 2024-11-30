@extends('layout')

@section('title', 'Results by Player')

@section('header', 'Results for Tournament')

@section('content')
    @include('result.results_table', ['results' => $results])
@endsection
