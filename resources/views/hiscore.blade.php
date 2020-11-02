@extends('layouts.layout')

@section('title')
	{{ ucfirst($hiscore) }} {{ __('title.hiscore') }}
@endsection

@section('content')


	<div class="row justify-content-center">
		<a href="{{ route('show-hiscore', ['skill', 'overall']) }}" class="mr-2">
			<div class="account-box">
				<p>Skills</p>
				<img class="pixel" src="{{ asset('images/skill') }}/Overall.png" width="54" alt="Overall skill icon">
			</div>
		</a>

		<a href="{{ route('show-hiscore', ['boss', Helper::listBosses()[0]]) }}" class="ml-2">
			<div class="account-box">
				<p>Bosses</p>
				<img class="pixel" src="{{ asset('images/boss') }}/boss.png" width="54" alt="Overall skill icon">
			</div>
		</a>
	</div>

	<div class="wide" id="highscore_top">
		<div class="highscore_selection">
			<span class="selection-top">
				@foreach ($hiscoreListTop as $skill)
					<a class="middle-icon" href="{{ route('show-hiscore', [$hiscoreType, $skill]) }}"><img class="middle-img-icon" src="{{ asset('images/'.$hiscoreType.'/') }}/{{ $skill }}.png" alt="{{ ucfirst($skill) }} {{ $hiscoreType }} icon"></a>
				@endforeach
			</span>
			<div class="mid-part">
				<span class="active middle-icon" style="display: inline-block;"><img class="pixel middle-img-icon" src="{{ asset('images/'.$hiscoreType.'/') }}/{{ $hiscore }}.png" alt="{{ ucfirst($hiscore) }} {{ $hiscoreType }} icon"><h1>{{ ucfirst($hiscore) }}</h1></span>
				@foreach ($hiscoreList as $skill)
					<span class="middle-icon"><img class="pixel middle-img-icon" src="{{ asset('images/'.$hiscoreType.'/') }}/{{ $skill }}.png" alt="{{ ucfirst($skill) }} {{ $hiscoreType }} icon"><h1>{{ ucfirst($skill) }}</h1></span>
				@endforeach
			</div>
			<span class="selection-bot">
				@foreach ($hiscoreListBottom as $skill)
					<a class="middle-icon" href="{{ route('show-hiscore', [$hiscoreType, $skill]) }}"><img class="middle-img-icon" src="{{ asset('images/'.$hiscoreType.'/') }}/{{ $skill }}.png" alt="{{ ucfirst($skill) }} {{ $hiscoreType }} icon"></a>
				@endforeach
			</span>
		</div>
	</div>

	@if ($accountCount > 0)
		<div class="float-left mt-3">
			<span class="middle-icon">
				<img class="pixel middle-img-icon" style="width: 150px; height: 150px;" src="{{ asset('images/'.$hiscoreType.'/') }}/{{ $hiscore }}.png" alt="{{ ucfirst($hiscore) }} skill icon">
			</span>
		</div>

		@if ($hiscoreType == "skill")
			<skillhiscore skill="{{ $hiscore }}"></hiscore>
		@elseif ($hiscoreType == "boss")
			<bosshiscore boss="{{ $hiscore }}"></hiscore>
		@endif
	@else
		<div class="text-center py-5">
			<img class="pixel" src="{{ asset('images') }}/ignore.png" width="75px" alt="Sad face">
			<h1>No accounts, no hiscores...</h1>
			<h2 class="text-center">Link an account <a href="{{ route('create-account') }}">here</a>!</h2>
		</div>
	@endif
@endsection