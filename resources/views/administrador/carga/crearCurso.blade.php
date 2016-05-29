@extends('layout.menuCarga')
@section('cuerpoPrincipalCarga')

<form method="POST" action="guardarCurso">

	{!! csrf_field() !!}
	<br>
	<div class="col-md-offset-2 col-md-8">
		<div class="panel panel-warning"  >
		<div class="panel-heading" >
			<h3 class="panel-title">Registrar Curso</h3>
		</div>

		<div class="panel-body">
			<div class="form-group">
				<!-- <div class="row"> -->
					<!-- <div class="col-lg-4" > -->
						<label class="control-label" for="focusedInput" >Nombre del curso:<spam style="color:red;">*</spam></label>
					<!-- </div> -->
					<!-- <div class="col-lg-6 "> -->
						<input class="form-control" id="focusedInput" type="text" name="nombre_curso" required pattern="^\D+[a-zA-Z_]{1,}\d*$" title="Solo se permiten minusculas y mayusculas.">

					<!-- </div> -->
				<!-- </div> -->
				<br />
				<div class="form-group">
					<!-- <div class="row"> -->
						<!-- <div class="col-lg-4" > -->
							<label class="control-label" for="focusedInput">Jornada:<spam style="color:red;">*</spam></label>
						<!-- </div>
						<div class="col-lg-6"> -->
							<select name="jornada" class="form-control">
								@foreach($jornadas as $jornada)
								<option value="{{$jornada->nombre}}">{{$jornada->nombre}}</option>
								@endforeach
							</select>
							<br>
						<!-- </div> -->
					<!-- </div> -->
				</div>
					<div class="form-group">
					<div class="row">
						<div class="col-lg-4" >
							<label class="control-label" for="focusedInput">Clases:<spam style="color:red;">*</spam></label>
						</div>
						<div class="col-lg-6">
								@foreach($clases as $clase)
								<label><input type="checkbox" value="{{$clase->id}}" name="clases[]">{{$clase->nombre}}</label>
								<br>
								@endforeach
						</div>
					</div>
				</div>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>

				<br>
				<div class="row">
					<!-- <div class="col-lg-4"></div> -->
					<div class="col-lg-12" style="text-align: center;">
						<button type="submit" class="btn btn-danger"> Guardar </button>
					</div>

				</div>

			</div>
		</div>
	</div>

	</div>
</form>



@stop
