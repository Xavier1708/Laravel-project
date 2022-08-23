@extends('layout.main')

@section('title', $eventONE->title)


@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{$eventONE->image}}" alt="{{$eventONE->title}}" class="img-fluid">
            </div>

            <div id="info-container" class="col-md-6">
                <h1>{{$eventONE->title}}</h1>
                <p class="event-city"> </ion-icon>{{"$eventONE->city"}}</p>
                <p class="event-participantes"><ion-icon name="star-outline"></ion-icon> {{ count($eventONE->users) }}  Participantes</p>
                <p class="event-owner">{{$eventOwner['name']}}</p>
                    @if(!$hasUserJoined)
                    <form action="/events/join/{{ $eventONE-> id }}" method="POST">
                    @csrf
                        <a 
                            href="/events/join/{{ $eventONE-> id }}"
                             class="btn btn-primary" 
                             id="event-submit" 
                             onclick="event.preventDefault(); 
                             this.closest('form').submit();">
                             Confirma presença
                        </a>
                  </form>
                    
                    @else
                         <p class="already-joined-msg">Você ja esta participando deste evento</p>   
                    @endif


                <div class="items">
                <h3>No Evento teremos:</h3>
                @foreach($eventONE->items as $eventone)
                    <li id="items-list"> {{$eventone}}</li>
                @endforeach
                </div>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento</h3>
                <p class="event-description">{{$eventONE->description}}</p>
            </div>
        </div>

    </div>

@endsection