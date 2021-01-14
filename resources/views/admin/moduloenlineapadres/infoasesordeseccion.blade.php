@extends('admin.menuprincipal')
@section('tittle','Familiares/Expediente')
@section('content')
<div class="col-sm-10">

<div class="box box-primary box-solid">
 <div class="box-header">
    <div class="col-sm-10" align="left">
        <h4> <label class="text-white">ASESOR DE SECCION</label></h4>
    </div>
  </div>
  <div class="box box-body">
    @foreach($asesor->usuarios as $usuario)
    <div class="col-sm-4" align="center">                 
           <img src="{{asset('/imagenes/Recursohumano/'.$usuario->foto)}}" class="user-image" alt="User Image" height="400px">
    </div>
    @endforeach

          <div class="col-sm-8"> 
            <form class="form-horizontal">
        
          <div class="form-group">                                           
          {!! Form::label('nombres', 'Nombre completo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_nombres',$asesor->v_nombres." ".$asesor->v_apellidos,['class'=>'form-control pull-right','placeholder'=>'Nombres', 'readonly']) !!}
          </div>
        </div>
        
         <div class="form-group"> 
          {!! Form::label('lbcel', 'Teléfono celular',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-phone"></i>
              </div>
              <input type="text" name="v_celular" class="form-control" value="{{$asesor->v_celular}}" readonly="true">
            </div>
          </div>
        </div>
        <div class="form-group">                                           
          {!! Form::label('lbcorreo', 'Correo electrónico',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
            {!! Form::text('v_correo',$asesor->v_correo,['class'=>'form-control pull-right','placeholder'=>'ejemplo@gmail.com','readonly']) !!}
            </div>
          </div>
        </form>
        </div>          
      </div> 
    
  
 </div>
<div class="box-footer" align="right"> 
    <a href="{{ route('estudiantes_familiares',Auth::user()->familiar->id) }}" class="btn btn-default">Regresar</a>

  </div>

</div>
</div>
 
@endsection



