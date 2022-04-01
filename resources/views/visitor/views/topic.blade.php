@extends('visitor.components.master')
@section('content')
<main class="main grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-2 bg-white">
			<section class="grid-content">
				<h1 class="topic-title">{{$topic->title}}</h1>
				<p class="topic-nav"><a class="no-underline font-bold" href="#">Anasayfa</a><font style="vertical-align: inherit;">→</font><a href="#" class="no-underline font-bold">{{$topic->course->name}}</a><font style="vertical-align: inherit;">→</font><a href="#" class="no-underline font-bold">{{$topic->title}}</a></p>
				{!!$topic->content!!}
			</section>
			<section class="grid-sidebar">
			@include('visitor.views.subpages.sidenav',['suggests' => $topic->suggest])
			</section>
		</main>
		<div class="container mt-3 mx-auto content-center justify-center">
			<div class="flex items-center space-x-1 mx-auto justify-center">

			    <a href="/topic/{{$topic->slug}}" class="px-4 py-2 text-gray-700 bg-white rounded-md hover:bg-blue-400 hover:text-white">
				1
			    </a>
			    <a href="/topic/{{$topic->slug}}/questions" class="px-4 py-2 text-gray-700 bg-white rounded-md hover:bg-blue-400 hover:text-white">
				2
			    </a>
			</div>	
		</div>
		@stop