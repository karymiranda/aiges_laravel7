@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Secciones/Competencias Ciudadanas')
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
    <h2 class="box-title"> CALIFICAR  COMPETENCIA : </h2>
    <label class="text-white"></label>
  </div>
  <form action="{{route('addSaveCompetenciaadmin')}}" method="POST">
    {{ csrf_field() }}
    <div class="box-body">

<div class="col-xs-6 col-sm-offset-3">
<table class="table table-bordered table-striped">
          <thead>
            <th>Criterio</th>
            <th>Descripción</th>
          </thead>
          <tbody>
             @foreach($comp as $key => $comp)
            <tr>
                <td>Criterio {{$key + 1}}</td>
                <td>{{$comp->competencia}}</td>
            </tr>
           @endforeach
          </tbody>
</table>
</div>
      <div class="col-xs-12">
        <table class="table table-bordered table-striped" id="">
          <thead>
            <th>ID</th>
            <th>NIE</th>
            <th>Nombre del alumno</th>
            <th width='100'>Criterio 1</th>
            <th width='100'>Criterio 2</th>
            <th width='100'>Criterio 3</th>
            <th width='100'>Criterio 4</th>
            <th width='100'>Criterio 5</th>
          </thead>
          <tbody>
            @foreach($students as $key => $student)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$student->v_nie}}</td>
                <td>{{$student->v_apellidos}} {{ $student->v_nombres }}</td>
                <td>
                  <select name="cr1[]" id="cr1[]" class="form-control" required>
                    {{-- <option value></option> --}}
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                </td>
                <td>
                  <select name="cr2[]" id="cr2[]" class="form-control" required>
                    {{-- <option value></option> --}}
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                </td>
                <td>
                  <select name="cr3[]" id="cr3[]" class="form-control" required>
                    {{-- <option value></option> --}}
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                </td>
                <td>
                  <select name="cr4[]" id="cr4[]" class="form-control" required>
                    {{-- <option value></option> --}}
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                </td>
                <td>
                  <select name="cr5[]" id="cr5[]" class="form-control" required>
                    {{-- <option value></option> --}}
                    <option value="E">E</option>	
                    <option value="MB">MB</option>
                    <option value="B">B</option>
                  </select>
                  <input type="hidden" name="nies[]" value="{{ $student->estudiante_id }}" />
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>  
    </div>
    <div class="box-footer" align="right">
      <input type="hidden" name="seccion" value="{{ $params['seccion_id'] }}">
      <input type="hidden" name="periodo" value="{{ $params['periodo'] }}">
      <input class="btn btn-primary" type="submit" value="Guardar">
      <a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
    </div>
  </form>
</div>
@endsection