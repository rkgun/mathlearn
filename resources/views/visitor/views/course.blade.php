@extends('visitor.components.master')
@section('title', $course->name)
@section('content')
<main class="main grid grid-cols-1 md:grid-cols-12 bg-white">
			<section class="grid-content">
				<h1 class="course-title">{{$course->name}}</h1>
				<p class="course-nav"><a class="no-underline font-bold" href="#">Anasayfa</a><font style="vertical-align: inherit;">→</font><a href="#" class="no-underline font-bold">{{$course->name}}</a></p>
				@include('visitor.views.subpages.topictree')
			</section>
			<section class="grid-sidebar">
			@include('visitor.views.subpages.sidenav',['suggests' => $course->suggest])
			</section>
		</main>
@stop