@extends('layout.main')

@section('title', 'Criar eventos')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group" >
        <label for="image">Carregar um foto:</label>
            <input type="file" id="image" name="image" class="form-controll-file">
        </div>
        
        <div class="form-group" >
        <label for="title">Evento:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>

        <div class="form-group" >
        <label for="dateEvt">Data de realização:</label>
        <input type="date" class="form-control" id="dateEvt" name="dateEvt">
        </div>

        <div class="form-group">
        <label for="title">Provincia:</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento">
        </div>

        <div class="form-group">
        <label for="title">O evento é privado ? :</label>
        <select name="private" id="private" class="form-control">
             <option value="0">Não</option>
             <option value="1">Sim</option>
        </select>
        </div>

        <div class="form-group">
        <label for="title">Descrição do evento:</label>
        <textarea name="description" id="description"  class="form-control" placeholder="Oque vai acontecer no do evento "></textarea>
        </div>

        <div class="form-group">
        <label for="title">Adicione oque tera no evento:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeira"> Cadeira
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cervejas"> Cervejas
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Mulheres Gostosas"> Mulheres Gostosas
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Musica ao vivo"> Musica ao Vivo
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Bar aberto"> Bar aberto
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Criar evento">
    </form>
</div>


@endsection