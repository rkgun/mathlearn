@extends('admin.components.master')
@section('content')
<section class="w-10/12">
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Mesaj Görüntüle</h1>
                    </div>
                </div>

                <div class="p-4 border-b border-gray-200 shadow">
                      Gönderen isim bilgisi: {{$contact->name}}<br><br>
                      Gönderen mail bilgisi: {{$contact->email}}<br><br>
                      Gönderim zaman bilgisi: {{$contact->created_at}}<br><br>
                      Mesaj: {{$contact->message}}<br><br>
                      Gönderen bilgisayar ip bilgisi: {{$contact->contact_ip}}<br><br>
                      Gönderen görüntülenme bilgisi: {{$contact->displayed}}<br><br>
                      Gönderen cevaplanma bilgisi: {{$contact->answered}}<br><br>
                      <form action="{!! route('contact.answered', ['id' => $contact->id]) !!}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  class="px-4 py-2 text-md text-white bg-red-400 rounded" type="submit">Sil</button>               
                      </form>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();

            });
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    
@stop