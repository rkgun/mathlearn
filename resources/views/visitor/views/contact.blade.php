@extends('visitor.components.master')
@section('content')
<main class="main container bg-white mx-auto p-8 text-gray-700shadow">
@if(Session::has('success'))
@include('visitor.components.success-alert')
@endif
<form id="contact-me" class="w-full" method="post" action="{{ route('contact.store') }}">
    <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5">İletişim</h2>
    {{ csrf_field() }}
    <!-- name field -->
    <div class="flex flex-wrap mb-6">
        <div class="relative w-full appearance-none label-floating">
            <input type="text" maxlength="150" pattern="[A-Za-z]{1,150}" class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
            name="name" id="name" type="text" placeholder="İsminiz" required>
            <label for="name" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                İsminiz
            </label>
        </div>
        @if ($errors->has('name'))
            @include('front.visitor.components.danger-alert',['content' => $errors->first('name')])
        @endif

    </div>
    <!-- email field -->
    <div class="flex flex-wrap mb-6">
        <div class="relative w-full appearance-none label-floating">
            <input type="email" patten="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
            name="email" id="email" type="text" placeholder="E-posta adresiniz" required>
            <label for="email" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                 E-posta adresiniz
            </label>
        </div>
        @if ($errors->has('email'))
            @include('front.visitor.components.danger-alert',['content' => $errors->first('email')])
        @endif
    </div>
    <!-- Message field -->
    <div class="flex flex-wrap mb-6">
        <div class="relative w-full appearance-none label-floating">
            <textarea class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                name="message" id="message" type="text" placeholder="Mesajın..."></textarea>
                <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Mesajınız
            </label>
        </div>
        @if ($errors->has('message'))
            @include('visitor.components.danger-alert',['content' => $errors->first('message')])
        @endif
    </div>

    <div class="">
        <button class="w-full shadow bg-gray-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
            type="submit">
            Gönder
        </button>
    </div>
</form>


<script>

// TEXT AREA AUTO EXPAND
var textarea = document.querySelector('textarea.autoexpand');
textarea.addEventListener('keydown', autosize);
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding: 1.4rem .2rem .5rem';
    
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}
</script>
    </main>
@stop