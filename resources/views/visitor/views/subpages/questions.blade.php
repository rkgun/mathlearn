@extends('visitor.components.master')
@section('content')
<main class="main grid grid-cols-1 md:grid-cols-12 gap-0 md:gap-2 bg-white">
			<section class="grid-content">
				<h1 class="topic-title">{{$topic->title}}</h1>
				<p class="topic-nav"><a class="no-underline font-bold" href="#">Anasayfa</a><font style="vertical-align: inherit;">→</font><a href="#" class="no-underline font-bold">{{$topic->course->name}}</a><font style="vertical-align: inherit;">→</font><a href="#" class="no-underline font-bold">{{$topic->title}}</a></p>
				{{$topic->questions}}
			</section>
			<section class="grid-sidebar">
				<div class="side-nav w-full">
					<div @click.away="open = false" class="flex flex-col w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
						<div class="flex-shrink-0 mx-8 my-4 flex flex-row items-center justify-between">
							<a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Öneriler</a>
							<button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
								<svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
									<path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
									<path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</button>
						</div>
						<nav :class="{'block': open, 'hidden': !open}" class="side-nav-content">
							<a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Blog</a>
							<a class="side-nav-item" href="#">Örnek Sayfa</a>
							<a class="side-nav-item" href="#">Örnek Sayfa</a>
							<a class="side-nav-item" href="#">PÖrnek Sayfa</a>
						</nav>
					</div>
				</div>
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