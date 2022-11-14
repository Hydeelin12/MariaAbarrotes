@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/inventario') }}" method="post" enctype="multipart/form-data">
@csrf
@include('inventario.form',['modo'=>'Crear']);

</form>
</div>
@endsection