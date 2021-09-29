@extends('admin.menuprincipal')
@section('tittle', 'Administración Activo Fijo/Cálculo de Depreciación')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>CALCULO DE DEPRECIACIÓN ACTVO FIJO</Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['route'=>['registrarcalculo',$anio], 'method'=>'GET','class'=>'form-horizontal']) !!}
            
        <div class="form-group"> 
          {!! Form::label('lbcod', 'Periodo a Depreciar',['class'=>'col-sm-5 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('anio',$anio,['class'=>'form-control pull-right','id'=>'id_codigo','placeholder'=>'Período a depreciar','readonly']) !!}
          </div> 
        </div>
    
           
        <div class="form-group"> 
          <div class="col-sm-12" align="center">
                  {!! Form::submit('Iniciar',['class'=>'btn btn-primary ']) !!}
          </div>                                                     
        </div>

<!--div class="form-group"> 
          <div class="col-sm-12" align="center">
        <div class="progress">
                <div  id="bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                  <span class="sr-only">40% Complete (success)</span>
                </div>
              </div>
</div>                                                     
        </div-->

      </div>
  
    <div class="box-footer" align="right">                
      <a href="{{route('depreciacionactivos')}}" class="btn btn-default">Regresar</a>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->
</div>
@endsection
@section('script')
 <script type="text/javascript">

$(document).ready(function(){
var progreso = 0;
var idIterval = setInterval(function(){
  // Aumento en 10 el progeso
  progreso +=10;
  $('#bar').css('width', progreso + '%');
	
  //Si llegó a 100 elimino el interval
  if(progreso == 100){
    clearInterval(idIterval);
  }
},1000);
}
 </script>
@endsection

