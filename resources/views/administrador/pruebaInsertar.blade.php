<form method="POST" action="{{route('guardarHorario')}}">
  <input type="text" name="idSeccion" placeholder="Id del Curso"><br>
  <input type="text" name="idMaestro" placeholder="Id del Maestro"><br>
  <input type="text" name="idClase" placeholder="Id de la clase"><br>
  <input type="text" name="horaInicio" placeholder="Hora inicio"><br>
  <input type="text" name="horaFin" placeholder="Hora final"><br>
  <button type="submit">Enviar</button>
</form>
