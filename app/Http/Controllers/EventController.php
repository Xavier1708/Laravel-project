<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    // FUNCAO PARA RETIRAR DO BANCO E MANDAR NA VIEW
    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
            ['title', 'like', '%'.$search.'%']
            ])->get();
        }else{

            $events = Event::all();
        }


        return view('welcome', ['events' => $events, 'search' => $search]);
    }



    public function store(Request $request){
        $event = new Event;

        $event->title = $request->title;
        $event->dateEvt = $request->dateEvt;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        

        // TRABALHANDO IMAGEM , OU SEJA ESTE CODIGO É PARA FAZER O UPLOAD DE IMAGENS

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")) . "." .$extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        // SALVANDO UM USUARIO NO EVENTO (USUARIO LOGADO)
        // O USUARIO TEM UMA RELACAO COM EVENTO

        $user = auth()->user();
        $event->user_id = $user->id;


        $event-> save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }



    // UMA OUTRA FUNCAO
    public function create(){
        return view('events.create');
    }

    public function show($id){
        $eventONE= Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;
        
        if($user){
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach( $userEvents as $userEvent ){
                  if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                  }  
            }

        }

        $eventOwner = User::where('id', $eventONE->user_id)->first()->toArray();

    return view('events.show', ['eventONE'=> $eventONE, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }


    public function dashboard(){
        $user = auth()->user();

        $events = $user->events;

        $eventsAsparticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsparticipant]);
    }

    // METODO PARA APAGAR UM EVENTO

    public function destroy($id){
        // findOrFail é um metodo que vai buscar um precistencia do Banco pelo ID passado
        Event::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');

    }

    // METODO PARA Buscar os dados do banco e enviar para os campos "input, date, label, etc para depos editar"

    public function edit($id) {

            $user = auth()->user();
            $event = Event::findOrFail($id);

            if($user->id != $event->user_id){
                return redirect('/dashboard');
            }

            return view ('events.edit', ['event' => $event]);

    }

    // METODO PARA ACTUALIZAR - VYVYVY

    public function update(Request $request){

        $data = $request->all();

              // TRABALHANDO IMAGEM , OU SEJA ESTE CODIGO É PARA FAZER O UPLOAD DE IMAGENS

              if($request->hasFile('image') && $request->file('image')->isValid()){
                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                $imageName = md5($requestImage->getClientOriginalName().strtotime("now")) . "." .$extension;
    
                $requestImage->move(public_path('img/events'), $imageName);
    
                $data['image'] = $imageName;
            }
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso!');
    }

    // SE JUNTAR AO EVENTO

    public function joinEvent($id){
        // pegando usuario logado
        $user = auth()->user();

        //SALVAR O USUARIO AO EVENTO
        $user->eventsAsParticipant()->attach($id);
        

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento " ' . $event->title . ' " ');
    }


    // funcao para sair do evento

    public function leaveEvent($id){
            $user = auth()->user();

            //  SAIR  DO  EVENTO
            $user ->eventsAsParticipant()->detach($id);

           $event = Event::findOrFail($id);

            return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento " ' . $event->title . ' " ');
    }
}
