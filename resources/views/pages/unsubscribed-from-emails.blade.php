@push('styles')
    <style>
		.main {
			padding-top: 5rem;
		}

		.logo {
			width: 200px;
		}


		.card {
			width: 80%;
			box-shadow: 0 0 40px rgba(0, 0, 0, 0.25);
		}

		.card .card-header {
			background-color: var(--main-color);
			padding: 1vh 1vw;
			color: white;
			font-weight: bold;
		}

		.card .card-body {
			padding: 1vh 1vw
		}

		.btn {
			align-items: center;
			background-clip: padding-box;
			background-color: var(--main-color);
			border: 1px solid transparent;
			border-radius: .25rem;
			box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
			box-sizing: border-box;
			color: #fff;
			cursor: pointer;
			display: inline-flex;
			font-size: 16px;
			font-weight: 600;
			justify-content: center;
			line-height: 1.25;
			margin: 1rem;
			min-height: 3rem;
			padding: calc(.875rem - 1px) calc(1.5rem - 1px);
			position: relative;
			text-decoration: none;
			transition: all 250ms;
			user-select: none;
			-webkit-user-select: none;
			touch-action: manipulation;
			vertical-align: baseline;
			width: auto;

		}

		.btn:hover,
		.btn:focus {
			box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
		}

		.btn:hover {
			transform: translateY(-1px);
		}

		.btn:active {
			background-color: #c85000;
			box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
			transform: translateY(0);
		}
    </style>
@endpush

@extends('pages.layout')

@section('content')
	<div class="main">
		<div class="flex justify-center">
			<img src="{{ url('images/logo_NDG.png') }}" class="logo" alt="logo">
		</div>

		<div class="flex justify-center mt-2">
			<div class="card">
				<div class="card-header">E-mail</div>
				<div class="card-body">
					<span style="display: block;">No recibirá más emails de {{ config('app.name') }}. Para volver a suscribirse cambie sus preferencias en la sección "Mis datos" de la plataforma.</span>
					<div class="flex justify-center">
						<a class="btn" href={{ config('app.dashboard_url') }}>Login</a>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection
