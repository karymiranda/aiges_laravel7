@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Calificaciones/Competencias Ciudadanas')
@section('content') 
<div class="box box-primary">
            <div class="box-header">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">COMPETENCIAS CIUDADANAS</label></h2>
              </div>
              <div class="col-sm-8" align="right">       
            
                <!--a href="{{route('agregarevaluacionesperiodo')}}" class="btn btn-primary">Registrar evaluación</a-->
              </div>
            </div>
            <HR>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda" style="width: 60%" align="center">
                <thead>
                <th>No</th> 
                <th>CODIGO</th> 
                <th>COMPETENCIA</th>                                         
                </thead>
                <tbody>
                  @foreach($competenciasciudadanas as $key=> $competencia)
                 <tr>                 
                <td>{{$key+1}}</td>
                <td>{{$competencia->codigo}}</td>
                <td>{{$competencia->competencia}}</td>
                </tr>  
                @endforeach  
                </tbody>               
              </table> 
            </div> 
          </div>          
   </div>           
@endsection
