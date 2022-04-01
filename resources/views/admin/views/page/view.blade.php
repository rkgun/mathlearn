@extends('admin.components.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css">
<style>
	.ck-balloon-panel{
		left:calc(60vw - 310px) !important;
	}	
</style>
<section class="w-10/12">
    <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">{{$page->name}}</h1>
                <span class="text-sm pl-2">Oluşturulma Tarihi :{{$page->created_at}} / Son Güncelleme Tarihi :{{$page->updated_at}}</span>
            </div>
        </div>
        <form class="container p-4 bg-white" enctype="multipart/form-data" action="{!! route('page.update', ['id' => $page->id]) !!}" method="POST">
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Nalet olsun!</strong>
                @foreach ($errors->all() as $error)
                    <span class="block sm:inline">{{ $error }}</span>
                @endforeach
                <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert(event)">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Kapat</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </button>
                </div>
                @endif
                    @method('PUT')
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Sayfa Başlık
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{$page->name}}">
                    </div>
                    <div class="md:flex md:items-center mb-4">
                            <label class="md:w-2/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" type="checkbox" name="active" {{ $page->active ? 'checked' : ''}}>
                            <span class="text-sm">
                                Sayfa Aktif
                            </span>
                            </label>
                    </div>

                    <div id="app" class="w-full">
                        <div class="mb-4 flex grid grid-cols-2 gap-3">
                            <label class="block text-gray-500 font-bold">Önceki resim:
                                <img class="h-96" src="{{$page->parallax_path}}"/>
                            </label>
                            <label class="block text-gray-500 font-bold">Şimdiki resim:
                            <div class="h-96 bg-contain bg-no-repeat" :style="{ 'background-image': `url(${previewImage})` }" @click="selectImage"></div>
                            </label>
                        </div>
                        <div class="mb-4">
                            <input type="file" ref="fileInput" @input="pickFile" name="image" placeholder="Resim seçiniz..." id="image">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold">Sayfa içeriği:</label>
                        <textarea id="content-editor" name="content-editor">
                        {!!$page->content!!}
                        </textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold">Parallax içeriği:</label>
                        <textarea class="mb-4 mt-4" id="parallax-editor" name="parallax-editor">
                            {!!$page->parallax_content!!}
                        </textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="meta-title">
                            Sayfa Meta-Başlık
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-title" name="meta-title" type="text" value="{{$page->meta->where('name','title')->first()->value}}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="meta-title">
                            Sayfa Meta-Açıklama
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-desc" name="meta-desc" type="text" value="{{$page->meta->where('name','description')->first()->value}}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="meta-keys">
                            Sayfa Meta-Anahtar Kelimeleri
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-keys" name="meta-keys" type="text" value="{{$page->meta->where('name','keywords')->first()->value}}">
                    </div>
                    <button type="submit" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">
                        Kaydet
                    </button>
                </form>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/mhchem.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/isaul32/ckeditor5@c3463fe834049bf5d805d1d22402108a9c0576bd/packages/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>

    <script>
        function getEditorData() {
            const data = window.editor.getData();
            const preview = document.getElementById('editor-preview');
            preview.innerHTML = data;
            renderMathInElement(preview);
            document.getElementById('editor-preview-html').innerText = data;
        }
        function getEditorData() {
            const data = window.editor2.getData();
            const preview = document.getElementById('editor-preview');
            preview.innerHTML = data;
            renderMathInElement(preview);
            document.getElementById('editor-preview-html').innerText = data;
        }

        ClassicEditor.create( document.querySelector( '#content-editor' ), {
            toolbar: ['heading','bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList','ckfinder','blockQuote','undo','redo','outdent','indent','math'],
            math: {outputType: 'span'},
            ckfinder: {
                uploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                options: {
                    resourceType: 'Images'
                }
            }
        }).then( editor => {window.editor = editor;}).catch( error=>{});

        ClassicEditor.create( document.querySelector( '#parallax-editor' ), {
            toolbar: ['heading','bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList','ckfinder','blockQuote','undo','redo','outdent','indent','math'],
            math: {outputType: 'span'},
            ckfinder: {
                uploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                options: {
                    resourceType: 'Images'
                }
            }
        }).then( editor => {window.editor2 = editor;}).catch( error=>{});
    </script>
    <script src="https://unpkg.com/vue@3"></script>
    <script>
         window.addEventListener('load',()=>{
            const app = Vue.createApp({
                el: '#app',
                data(){
                    return{
                        previewImage:null
                    }
                },
                methods:{
                    selectImage () {
                        this.$refs.fileInput.click()
                    },
                    pickFile () {
                        let input = this.$refs.fileInput
                        let file = input.files
                        if (file && file[0]) {
                        let reader = new FileReader
                        reader.onload = e => {
                            this.previewImage = e.target.result
                        }
                        reader.readAsDataURL(file[0])
                        this.$emit('input', file[0])
                        }
                    }
                },
            });
            app.mount('#app')
        });
    </script>
@stop