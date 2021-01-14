@extends('admin.menuprincipal')
@section('tittle','Acerca de')
@section('content')
<div class="box box-primary box-solid">
	<div class="box-header with-border">
              <h3 class="box-title"><Strong>ACERCA DEL SISTEMA</Strong></h3>
            </div>
 {!! Form::open(['class'=>'form-horizontal']) !!}
            <!-- /.box-header -->
            <div class="box-body">
              
               <div class="col-sm-12" align="center">
                <output id="list"><img src="{{asset('/imagenes/recursosrpt/acercade.jpg')}}" max-with="100%"></output>
               </div>


            </div>
     <div class="box-footer" align="right">                
       
         <a href="{{route('menu')}}" class="btn btn-default">Regresar</a>
        </div>

        {!! Form::close() !!}          <!-- /.box-body -->
 </div>
@endsection
