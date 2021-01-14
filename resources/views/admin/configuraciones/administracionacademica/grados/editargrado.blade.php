@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Grados')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR GRADO</Strong></h3>
            </div>
            
             @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">

                  {!! Form::open(['route'=>['actualizargrado',$grado->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                                                {!! Form::label('grado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('grado',$grado->grado,['class'=>'form-control pull-right','placeholder'=>'Descripción','required']) !!}
                                                </div>
                </div>
                   <div class="form-group">                                           
          {!! Form::label('nivel', 'Nivel acádemico',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">

        <input type="radio" name="nivel_educativo" class="flat-red" value="Educación inicial" <?php if($grado->nivel_educativo=="Educación inicial"){ ?> checked="checked" <?php } ?> >
        {!! Form::label('lbinicial', 'Educación inicial',['class'=>'control-label']) !!}<br>        
           
      <input type="radio" name="nivel_educativo" class="flat-red" value="Educación parvularia" <?php if($grado->nivel_educativo=="Educación parvularia"){ ?> checked="checked" <?php } ?> >
        {!! Form::label('lbparvularia', 'Educación parvularia',['class'=>'col- control-label'])!!}<br>         
              
       <input type="radio" name="nivel_educativo" class="flat-red" value="Educación básica primer ciclo" <?php if($grado->nivel_educativo=="Educación básica primer ciclo"){ ?> checked="checked" <?php } ?> >     
       {!! Form::label('lbbasica', 'Educación básica primer ciclo',['class'=>'control-label']) !!}  <br>      
      
       <input type="radio" name="nivel_educativo" class="flat-red" value="Educación básica segundo ciclo" <?php if($grado->nivel_educativo=="Educación básica segundo ciclo"){ ?> checked="checked" <?php } ?> >    
      {!! Form::label('lbbasica', 'Educación básica segundo ciclo',['class'=>'control-label']) !!}<br>      
          
      <input type="radio" name="nivel_educativo" class="flat-red" value="Educación básica tercer ciclo" <?php if($grado->nivel_educativo=="Educación básica tercer ciclo"){ ?> checked="checked" <?php } ?> >
      {!! Form::label('lbbasica', 'Educación básica tercer ciclo',['class'=>'control-label']) !!}  <br>        
             </div> 
            </div>                                                           
          </div>

         
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listagrados')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>





@endsection
