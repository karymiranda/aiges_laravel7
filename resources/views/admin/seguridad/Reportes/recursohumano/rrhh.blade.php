<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/php; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
  <link href="{{ asset('adminlte/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"-->
   <style>
 	body { font-family: DejaVu Sans; }
   
	@page {
      margin: 160px 50px;
    }
	header { 
	  position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    .img-der {
      position: fixed;
      right: 10px;
      top: -150px;
      width: 80px;
      height: 80px;
    }
    .img-izq {
      position: fixed;
      left: 10px;
      top: -150px;
      width: 80px;
      height: 80px;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -120px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }

	</style>
</head>
<body>
	
	<header>
		<h1>Santa María del Camino</h1>
	    <h2>Reporte de Recurso Humano</h2>
	    <hr>
  	</header>
  	<img class="img-izq" src="{{ asset('imagenes/cho.jpg') }}" />
  	<img class="img-der" src="{{ asset('imagenes/cho.jpg') }}" />
    <div class="container">
	    <div class="row">
			<table class="table table-bordered">
		      <thead>
            <tr class="active">
          <th>EXPEDIENTE</th> 
          <th>NOMBRE COMPLETO</th>
          <th>DIRECCION</th>
          <th>DUI</th>
          <th>CARGO</th>
          <th>CELULAR</th></tr>
        </thead>
        <tbody>
          @foreach($data as $empleado)          
            <tr>            
              <td>{{ $empleado->v_numeroexp }}</td>
              <td>{{ $empleado->v_nombres . ' ' . $empleado->v_apellidos }}</td>
              <td>{{ $empleado->v_direccioncasa }}</td>
              <td>{{ $empleado->v_dui }}</td>
              <td>{{ $empleado->cargo->v_descripcion }}</td>
              <td>{{ $empleado->v_celular }}</td>
            </tr>
          @endforeach
        </tbody>
			</table>
	    </div>    
  	</div>
	<footer>
  		<table>
      <tr>
        <td>
            <p class="izq">
              {{$today}}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
    </footer>
</body>
</html>