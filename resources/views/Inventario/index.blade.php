
<body style="background-color:#75EFC3  ;">
@section('content')
<div class="container">


@if(Session::has('mensaje'))  
<div class="alert alert-success alert-dismissible" role="alert">  
{{ Session::get('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times;</span>
</button>

</div>
@endif



<a href="{{url('inventario/create')}}"class="btn btn-Primary"> Registrar nuevo inventario </a>
<br/>
<br/>
<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Codigo</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>


    <tbody>
        @foreach($inventarios as $inventario)
        <tr>
            <td>{{$inventario->id}}</td>

            <td>
            <img class="img-thubnail img-fluid" src="{{ asset('storage').'/'.$inventario->Foto }}" width="100" alt="">
            
            </td>


            <td>{{$inventario->Nombre}}</td>
            <td>{{$inventario->Marca}}</td>
            <td>{{$inventario->Codigo}}</td>
            <td>{{$inventario->Precio}}</td>
            <td>


            <a href="{{ url('/inventario/'.$inventario->id.'/edit' ) }}" class="btn btn-info">

                   Editar 
            </a>
        
            

            
            <form action="{{url('/inventario/'.$inventario->id )}}" class="d-inline" method="post">
            @csrf
            {{method_field('DELETE') }}
            <input class="btn btn-Dark" type="submit" onclick="return confirm('¿Quieres Borrar?')"  
            value="Borrar">

            </form>
             
           
        
        </td>
        </tr>
        @endforeach

    </tbody>
    
</table>
{!! $inventarios->links()!!}
</div>
</body>@extends('layouts.app')
@endsection