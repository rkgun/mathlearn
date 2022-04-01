@extends('admin.components.master')
@section('content')
<section class="w-10/12">
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Ayarlar Listesi</h1>
                    </div>
                </div>

                <div class="p-4 border-b border-gray-200 shadow">
                        <!-- <table> -->
                        <table id="dataTable" class="p-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-8 text-xs text-gray-500">
                                        İsim
                                    </th>
                                    <th class="p-8 text-xs text-gray-500">
                                        Değer
                                    </th>
                                    <th class="p-8 text-xs text-gray-500">
                                        Oluşturulma Zamanı
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
                                @foreach ($settings as $setting)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{$setting->name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{$setting->value}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{$setting->created_at}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{!! route('setting.read', ['id' => $setting->id]) !!}" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Görüntüle</a>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                    @if($setting->locked==true)
                                        <span class="px-4 py-1 text-sm text-white bg-red-400 rounded">
                                        Bu ayar silinemez
                                        </span>
                                    @elseif($setting->locked==false)
                                        <form action="{!! route('setting.delete', ['id' => $setting->id]) !!}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button  class="px-4 py-1 text-sm text-white bg-red-400 rounded" type="submit">Sil</button>               
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{!! route('setting.create')!!}" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Ayar Ekle</a>
                        <a href="{!! route('setting.sitemap')!!}" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Otomatik Sitemap oluştur</a>
                </div>
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