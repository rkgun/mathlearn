<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8" />
		<title>{{$setting['site_name']}} | @yield('title','Anasayfa')</title>
		<link rel="icon" href="{{asset($setting['icon'])}}">

		@if(isset($metas))
			@foreach($metas as $meta)
				<meta name="{{$meta->name}}" content="{{$meta->value}}">
			@endforeach
		@endif

		<link rel="canonical" href="{{url()->current()}}"/>
        <base href="{{ asset('/') }}" />
		<meta name="author" content="{{asset($setting['author'])}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link rel="stylesheet" href="{{asset('css/app.css')}}" />
		<script src="{{asset('js/app.js')}}"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.15.1/dist/katex.min.css" integrity="sha384-R4558gYOUz8mP9YWpZJjofhk+zx0AS11p36HnD2ZKj/6JR5z27gSSULCNHIRReVs" crossorigin="anonymous">
	</head>
	<body>

		<header>
			<div class="navbar">
				<div x-data="{ open: false }"  class="navbar-content">
					<div class="navbar-brand">
						<a href="/index" class="navbar-brand-link">{{$setting['site_name']}}</a>
					</div>
					<nav :class="{'flex': open, 'hidden': !open}" class="navbar-nav hidden md:flex">
						<a class="navbar-item" href="{{ url('about-us') }}">Hakkımızda</a>
						<a class="navbar-item" href="{{ url('contact') }}">İletişim</a>
						<div @click.away="open = false" class="relative" x-data="{ open: false }">
							<button @click="open = !open" class="dropdown-btn">
								<span>Dersler</span>
								<svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</button>
							<div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="dropdown-content">
								<div class="dropdown-list">
									@foreach($courses as $course)
									<a class="dropdown-item" href="/course/{{$course->slug}}">{{$course->name}}</a>
									@endforeach
								</div>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>