<table>
  <thead>
     <tr><th>JUNIO-2020</th>  </tr>
    <tr>
      <th>NIP</th> 
      <th>NOMBRE COMPLETO</th>
       @for($d=1;$d<=$ultimo_dia;$d++)
        <th>{{$d}}</th>
       @endfor

    </tr>
  </thead>
  <tbody>
 
      @foreach($datos as $datos)
      @for($d=1;$d<=$ultimo_dia;$d++)
        <th>{{$d}}</th>       
        <th>{{$datos[$d] }</th>
        @endfor
      @endforeach
  </tbody>
</table>