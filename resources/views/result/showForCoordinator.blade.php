@extends('layout')

@section('title', $player->name . "'s Results")

@section('header', $player->name . "'s Results")
    @section('content')
        @include('result.results_table', ['results' => $results, 'showActions' => true])
    @endsection
