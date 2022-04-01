@extends('visitor.components.master')
@section('title',$page->name)
@section('content')
<div class="parallax" style="background-image:url({{ asset($page->parallax_path) }})">
	  <div class="parallax-content">
	 	 {!!html_entity_decode($page->parallax_content)!!}
	  </div>
</div>

<main class="main">
	{!!html_entity_decode($page->content)!!}
</main>
@stop