@extends('layouts.layout')

@section('title')
    {{ $account->username }}
@endsection

@section('content')
    <div class="col-md-12 bg-dark text-light background-dialog-panel py-3 mb-3">
        @if ($account->user->private === 0 || (Auth::check() && $account->user->id == Auth::user()->id))
            <div class="row">
                <div class="col-md-8">
                    <accounthiscore account="{{ $account->username }}"></accounthiscore>
                </div>

                <div class="col-md-4">
                    <accountnotification :account="{{ $account }}"></accountnotification>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <img src="{{ asset('images/ignore.png') }}"
                     class="pixel icon"
                     alt="Sad face">
                <h1>This user is private</h1>
            </div>
        @endif
    </div>
@endsection
