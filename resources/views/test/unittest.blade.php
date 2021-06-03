@extends('layouts.app')

@section('title', 'Unit Test')

@section('content')
    <style>
        iframe {
            min-height: 200px !important;
            height: 200px;
        }
    </style>
    <div class="container">
        <h6 class="text-info">Users</h6>
        <iframe src="/unittest/users"></iframe>
        <h6 class="text-info">usersActivity</h6>
        <iframe src="/unittest/usersActivity"></iframe>
        <h6 class="text-info">usersCreditHistory</h6>
        <iframe src="/unittest/usersCreditHistory"></iframe>
        <h6 class="text-info">usersFinance</h6>
        <iframe src="/unittest/usersFinance"></iframe>
        <h6 class="text-info">usersRating</h6>
        <iframe src="/unittest/usersRating"></iframe>
        <h6 class="text-info">usersAdviceQuery</h6>
        <iframe src="/unittest/usersAdviceQuery"></iframe>
    </div>
@endsection
