@extends('layout.main')

@section('title', 'Dasboard')


@section('content')

    <div class="col-md-10 offset-md-1 deshboard-title-container">
        <h1>Meus eventos</h1>
    </div>

     <div class="col-md-10 offset-md-1 deshboard-events container">
         @if(count($events) > 0)

         @else
            <p>Você ainda não tem nenhum evento, <a href="/events/create">Criar evento</a></p>
         @endif
     </div>

@endsection