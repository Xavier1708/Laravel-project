@extends('layout.main')

@section('title', 'Dasboard')


@section('content')

    <div class="col-md-10 offset-md-1 deshboard-title-container">
        <h1>Meus eventos</h1>
    </div>

     <div class="col-md-10 offset-md-1 deshboard-events-container">
         @if(count($events) > 0)
             <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>

             <tbody>
                  @foreach($events as $event)
                    <tr>
                        <td scope="row"> {{ $loop->index + 1 }} </td>
                        <td> <a href="/events/{{ $event->id }}"> {{ $event -> title }}</a>  </td>
                        <td> {{ count($event->users) }} </td>
                        <td> 
                            <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">Editar</a> 
                            <form action="/events/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"> Deletar</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
             </tbody>
             </table>
         @else
            <p>Você ainda não tem nenhum evento, <a href="/events/create">Criar evento</a></p>
         @endif
     </div>




     <div class="col-md-10 offset-md-1 deshboard-title-container">
        <h1>Eventos em que estou participando</h1>
    </div>
 <div class="col-md-10 offset-md-1 deshboard-events-container">
        @if( count($eventsasparticipant  ) > 0) 
            <table class="table">

                    <thead>
                         <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Participantes</th>
                              <th scope="col">Ações</th>
                         </tr>
                    </thead>

                    <tbody>
        @foreach($eventsasparticipant as $event)
                    <tr>
                        <td scope="row"> {{ $loop->index + 1 }} </td>
                        <td> <a href="/events/{{ $event->id }}"> {{ $event -> title }}</a>  </td>
                        <td> {{ count($event->users) }} </td>
                        <td> 
                            <form action="/events/leave/{{ $event->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn btn-danger delete-btn">Sair do evento</button> 
                            </form>
                        </td>
                    </tr>
        @endforeach
                </tbody>
    </table>



        @else
            <p>Você ainda não esta participando em nenhum evento <a href="/"> ver eventos disponiveis</a></p>
        @endif
    </div>
    

@endsection