<h1>{{ $modo }} inventario </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
<ul>
        @foreach( $errors->all() as $error)
       <li> {{ $error }} </li>
    @endforeach
</ul>
    </div>


@endif

<div class="form-group">

<label for="Nombre"> Nombre </label>
<input type="text" class="form-control" name="Nombre" 
value="{{isset($inventario->Nombre)?$inventario->Nombre:old('Nombre') }}" id="Nombre">
</div>

<div class="form-group">

<label for="Marca"> Marca </label>
<input type="text" class="form-control" name="Marca" 
value="{{isset($inventario->Marca)?$inventario->Marca:old('Marca') }}" id="Marca">
</div>

<div class="form-group">

<label for="Codigo"> Codigo </label>
<input type="text" class="form-control" name="Codigo"  
value="{{isset($inventario->Codigo)?$inventario->Codigo:old('Codigo') }}" id="Codigo">
</div>

<div class="form-group">
<label for="Precio"> Precio </label>
<input type="text" class="form-control" name="Precio" 
value="{{isset($inventario->Precio)?$inventario->Precio:old('Precio')}}" id="Precio">
</div>

<label for="Foto"> </label>
@if(isset($inventario->Foto))
<img class="img-thubnail img-fluid" src="{{ asset('storage').'/'.$inventario->Foto }}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
</div>
<input class="btn btn-success" type="submit" value=" {{ $modo }} Datos ">

<a class="btn btn-primary" href="{{url('inventario/')}}"> Regresar  </a>


<br>


