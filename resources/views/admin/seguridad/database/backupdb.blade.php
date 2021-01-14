@extends('admin.menuprincipal')
@section('tittle','Respaldo de Base de Datos')
@section('content')
<div class="box box-primary box-solid">
	<div class="box-header with-border">
              <h3 class="box-title"><Strong>RESPALDO</Strong></h3>

<div class="box-tools pull-right">

<div class="btn-group ">
               
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <span class="fa fa-ellipsis-v"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                   <ul class="dropdown-menu" role="menu">
                    <li><a href="{{route('ayuda')}}">Ayuda</a></li>
                  </ul>
                  <!--ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul-->
                </div>
              
                <!--button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
</div>
</div>

 {!! Form::open(['class'=>'form-horizontal']) !!}
            <!-- /.box-header -->
            <div class="box-body">

            	<table class="table table-bordered table-striped" id="tablaBusqueda" data-toggle="dataTable" >
      <thead>
        <th>No</th>
        <th>ARCHIVO</th> 
        <th>TAMAÑO</th> 
        <th>FECHA DE CREACION</th>                 
        <th>ACCIONES</th>
      </thead>
      <tbody>

 @for($x=0;$x<$n;$x++)        
          <tr>
            <td>{{$x+1}}</td>
            <td>{{$archivos[$x][0]}}</td>
           <td>{{$archivos[$x][2]}} bytes</td>
            <td>{{$archivos[$x][1]}}</td>
            <td>
              
          <a href="{{route('restaurardb',$archivos[$x][0])}}" title="Restaurar respaldo" class="btn btn-warning"><i class="fa fa-arrow-up"></i></a>     
          </td>
          </tr>           
@endfor

      </tbody>      
    </table>

              
            </div>
     <div class="box-footer" align="right">                
         <a href="{{route('menu')}}" class="btn btn-default">Regresar</a>

        </div>

        {!! Form::close() !!}          <!-- /.box-body -->
 </div>
@endsection
