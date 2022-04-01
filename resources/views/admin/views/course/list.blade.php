@extends('admin.components.master')
@section('content')
<section class="w-10/12">
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Dersler Listesi</h1>
                    </div>
                </div>

                <div class="p-4 border-b border-gray-200 shadow">
                        <!-- <table> -->
                        <table id="dataTable" class="p-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-8 text-xs text-gray-500">
                                        Ders İsmi
                                    </th>
                                    <th class="p-8 text-xs text-gray-500">
                                        Atkif/İnaktif
                                    </th>
                                    <th class="p-8 text-xs text-gray-500">
                                        Oluşturulma Zamanı
                                    </th>
                                    <th class="p-8 text-xs text-gray-500">
                                        Alt Konu Sayısı
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Detaylar
                                    </th>
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        Sil
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($courses as $course)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{$course->name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-500">
                                            {{$course->active ? 'Aktif' : 'İnaktif'}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-500">
                                        {{$course->created_at}}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{$course->topics->count()}}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{!! route('course.view', ['id' => $course->id]) !!}" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Görüntüle</a>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{!! route('course.delete', ['id' => $course->id]) !!}" class="px-4 py-1 text-sm text-white bg-red-400 rounded">Sil</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <form class="container p-4 bg-white" action="{!! route('course.store')!!}" method="POST">
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
                    @method('POST')
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Ders İsim
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="Ders İsmi">
                    </div>
                    <div class="md:flex md:items-center mb-4">
                            <label class="md:w-2/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" type="checkbox" name="active">
                            <span class="text-sm">
                                Ders Aktif
                            </span>
                            </label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Kurs Meta-Başlık
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-title" name="meta-title" type="text" value="meta-başlık">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="meta-title">
                            Kurs Meta-Açıklama
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-desc" name="meta-desc" type="text" value="meta-açıklama">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="meta-keys">
                            Kurs Meta-Anahtar Kelimeleri
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="meta-keys" name="meta-keys" type="text" value="meta-kelimeler">
                    </div>
                    <button type="submit" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">
                        Ekle
                    </button>
                </form>
            </div>
        </section>
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
            function closeAlert(event){
                let element = event.target;
                while(element.nodeName !== "BUTTON"){
                element = element.parentNode;
                }
                element.parentNode.parentNode.removeChild(element.parentNode);
            }
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    
@stop