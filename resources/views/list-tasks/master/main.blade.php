<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('page-title') - {{ setting('app_name') }}</title>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets/img/icons/apple-touch-icon-144x144.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('assets/img/icons/apple-touch-icon-152x152.png') }}" />
	<link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-32x32.png') }}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-16x16.png') }}" sizes="16x16" />
	<meta name="application-name" content="{{ setting('app_name') }}"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="{{ url('assets/img/icons/mstile-144x144.png') }}" />

	<link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/vendor.css')) }}">
	<link media="all" type="text/css" rel="stylesheet" href="{{ url(mix('assets/css/app.css')) }}">
	@yield('styles')
	@hook('app:styles')
</head>
<body>
<div class="content-task px-5">
	<div class="container-fluid bg-white">
		<div class="row task-table-header pb-4">
			<div class="col-sm">
				<div class="logo d-flex align-item">
					<a href="/"><img src="{{url('assets/img/logo.png')}}" alt="moh logo"></a>
					<p class="name-text ml-3 mb-0 font-weight-bold font-moul" style="line-height: 1.8">អនុគណៈកម្មការឆ្លើយតបបន្ទាន់និងស្រាវជ្រាវរកបុគ្គលផ្ទុកមេរោគកូវីដ-១៩</p>
				</div>

			</div>
			<div class="col-sm align-self-center">
				<h3 class="title font-moul mb-0 text-center">
					តារាងភារកិច្ច
				</h3>
			</div>
			@php 
				$currentDate = date_create(getCurrentDate());
				$date = date_format($currentDate, "d/m/Y H:i");
				$chankitek = getKhChankitek();
			@endphp
			<div class="col-sm">
				<p class="date text-right mb-0">
					ថ្ងៃ {{$chankitek->kh_day}} {{$chankitek->kh_date}} ខែ {{$chankitek->kh_month}} ឆ្នាំ{{$chankitek->kh_year_name}} {{$chankitek->kh_sak}}, ព.ស{{$chankitek->kh_year}}
					<time class="d-block">{{$date}}</time>
				</p>
			</div>
			<div class="col-12">
				<div class="btn-group mt-4" role="group" aria-label="Basic example">
					<a href="{{ route('list-tasks') }}" type="button" class="btn btn-outline-primary {{ getCurrentRouteName() == 'list-tasks' ? 'active' : ''}}">ភារកិច្ចថ្មី</a>
					<a href="{{ route('list-tasks.process') }}" type="button" class="btn btn-outline-primary {{ getCurrentRouteName() == 'list-tasks.process' ? 'active' : ''}}">ភារកិច្ចកំពុងធ្វើ</a>
					<a href="{{ route('list-tasks.done') }}" type="button" class="btn btn-outline-primary {{ getCurrentRouteName() == 'list-tasks.done' ? 'active' : ''}}">ភារកិច្ចបានធ្វើរួច</a>
					<a href="{{ route('patients') }}" type="button" class="btn btn-outline-primary">ព័ត៌មានអ្នកជម្ងឺ</a>
				</div>
			</div>
		</div>

	</div>

    @yield('content')


</div>

<script src="{{ url(mix('assets/js/vendor.js')) }}"></script>
<script src="{{ url('assets/js/as/app.js') }}"></script>
@yield('scripts')

@hook('app:scripts')
</body>
</html>
