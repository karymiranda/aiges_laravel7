@extends('admin.menuprincipal')
@section('tittle', 'Administración Activo Fijo/Gestion de Datos Masivo / Activo Fijo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>GESTION DE DATOS MASIVOS</Strong></h3>
  </div>
  <!-- /.box-header -->
@if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

 @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

@if(session()->has('failures'))
</table>
</tr>
</td>Fila</td>
</td>Atributo</td>
</td>Error</td>
</td>Valor</td>
</tr>

 @foreach(session()->get('failures') as $error)
</tr>
</td>{{$error}}</td>
</td></td>
</td></td>
</td></td>
</tr>   
@endforeach
</table>
  @endif


  <!-- form start -->
  <div class="box-body">

    {!! Form::open(['route'=>'store', 'method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
 @csrf
    <div class="form-group"> 

     {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
 <div class="col-sm-8">
 <input type="file" name="file" id="file" />
  <button type="submit" class="btn btn-primary">Importar</button>
 </div>
 </div>

    </div>


    <div class="box-footer" align="right">                
                  <a href="{{route('activofijo')}}" class="btn btn-default">Regresar</a>
    </div>

  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection
