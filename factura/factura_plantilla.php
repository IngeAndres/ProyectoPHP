<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Recibo-Econocable</title>
	<style>
		@import url('fonts/BrixSansRegular.css');
		@import url('fonts/BrixSansBlack.css');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		p,
		label,
		span,
		table {
			font-family: 'BrixSansRegular';
			font-size: 9pt;
		}

		.h2 {
			font-family: 'BrixSansBlack';
			font-size: 16pt;
		}

		.h3 {
			font-family: 'BrixSansBlack';
			font-size: 12pt;
			display: block;
			background: #0a4661;
			color: #FFF;
			text-align: center;
			padding: 3px;
			margin-bottom: 5px;
		}

		#page_pdf {
			width: 95%;
			margin: 15px auto 10px auto;
		}

		#factura_head,
		#factura_cliente,
		#factura_detalle {
			width: 100%;
			margin-bottom: 10px;
		}

		#factura_head .logo_factura div img {
			max-width: 150px;
			/* Puedes ajustar este valor según tus necesidades */
			max-height: 100px;
			/* Puedes ajustar este valor según tus necesidades */
		}

		.info_empresa {
			width: 50%;
			text-align: center;
		}

		.info_factura {
			width: 25%;
		}

		.info_cliente {
			width: 100%;
		}

		.datos_cliente {
			width: 100%;
		}

		.datos_cliente tr td {
			width: 50%;
		}

		.datos_cliente {
			padding: 10px 10px 0 10px;
		}

		.datos_cliente label {
			width: 75px;
			display: inline-block;
		}

		.datos_cliente p {
			display: inline-block;
		}

		.textright {
			text-align: right;
		}

		.textleft {
			text-align: left;
		}

		.textcenter {
			text-align: center;
		}

		.round {
			border-radius: 10px;
			border: 1px solid #0a4661;
			overflow: hidden;
			padding-bottom: 15px;
		}

		.round p {
			padding: 0 15px;
		}

		#factura_detalle {
			border-collapse: collapse;
		}

		#factura_detalle thead th {
			background: #058167;
			color: #FFF;
			padding: 5px;
		}

		#detalle_productos tr:nth-child(even) {
			background: #ededed;
		}

		#detalle_totales span {
			font-family: 'BrixSansBlack';
		}

		.nota {
			font-size: 8pt;
		}

		.label_gracias {
			font-family: verdana;
			font-weight: bold;
			font-style: italic;
			text-align: center;
			margin-top: 20px;
		}

		.anulada {
			position: absolute;
			left: 50%;
			top: 10%;
			/* Ajusta el porcentaje según sea necesario */
			transform: translateX(-50%);
			opacity: 0.1;
		}

		.importe_total_izquierda {
			width: 30%;
			padding: 10px;
			box-sizing: border-box;
			border: 1px solid #000;
			text-align: left;
			margin-right: auto
		}

		.importe_total_derecha {
			width: 30%;
			padding: 10px;
			box-sizing: border-box;
			border: 1px solid #000;
			text-align: right;
			margin-left: auto;/
		}

		#importe_total p {
			margin: 0;
		}

		#info_adicional {
			border: 1px solid black;
			/* Color negro para el borde */
			padding: 10px;
			/* Espacio interno alrededor del contenido */
			margin-top: 20px;
			/* Espacio superior entre el contenido anterior y este bloque */
			width: 50%;
			/* Ancho del bloque (ajusta según sea necesario) */
			margin-left: auto;
			/* Centrar el bloque horizontalmente */
			margin-right: auto;
			/* Centrar el bloque horizontalmente */
		}

		#info_adicional p {
			margin-bottom: 10px;
			/* Espacio entre párrafos */
		}
	</style>
</head>

<body>
	<img class="anulada" src="img/cancelado.png" alt="Cancelado">
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img class="logo_factura" src="img/logo.png">
					</div>
				</td>
				<td class="info_empresa">
					<div>
						<span class="h2">ECONOCABLE PERÚ</span>
						<p>Jr. Galvez 525, Barranca 15169</p>
						<p>Teléfono: (01) 6418000</p>
						<p>Email: ventasdigitales@econocable.com</p>
					</div>
				</td>
				<td class="info_factura">
					<div class="round">
						<span class="h3">Recibo</span>
						<p>RUC N°<strong>20600034864</strong></p>
						<p id="fecha"></p>
						<p id="hora"></p>
						<p>RECIBO: <strong><?php echo $row['numeReci'] ?></strong></p>
					</div>
				</td>
			</tr>
		</table>
		<table id="factura_cliente">
			<tr>
				<td class="info_cliente">
					<div class="round">
						<span class="h3">Cliente</span>
						<table class="datos_cliente">
							<tr>
								<td><label>Nombre:</label>
									<p><?php echo $row['raznSociClie'] ?></p>
								</td>
								<td><label>Celular 1:</label>
									<p><?php echo ($row['celuClie'] != null ? $row['celuClie'] : '-') ?></p>
								</td>
							</tr>
							<tr>
								<td><label>Dirección:</label>
									<p><?php echo $row['direccion'] ?></p>
								</td>
								<td><label>Celular 2:</label>
									<p><?php echo ($row['celuClie2'] != null ? $row['celuClie2'] : '-') ?></p>
								</td>
							</tr>
							<tr>
								<td><label>RUC/DNI:</label>
									<p><?php echo $row['numeDocu'] ?></p>
								</td>
								<td><label>Fecha de venc.:</label>
									<p><?php echo $row['fechVenc'] ?></p>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>

		<table id="factura_detalle">
			<thead>
				<tr>
					<th class="textcenter" width="50px">CÓDIGO</th>
					<th class="textleft">DESCRIPCIÓN</th>
					<th class="textcenter" width="100px">CANTIDAD</th>
					<th class="textright" width="150px">P.U</th>
					<th class="textright" width="150px">DSCTO</th>
					<th class="textright" width="150px">SUBTOTAL</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<tr>
					<td class="textcenter"><?php echo $row['codiConc'] ?></td>
					<td>
						<?php echo $row['nombConc'] ?> <br>
						<?php echo $row['nombPlan'] ?> <br>
						<?php echo $row['nombUbig'] ?>
					</td>
					<td class="textcenter">1</td>
					<td class="textright">S/.<?php echo number_format($row['montReci'], 2) ?></td>
					<td class="textright">0.00</td>
					<td class="textright">S/.<?php echo number_format($row['montReci'], 2) ?></td>
				</tr>
			</tbody>
		</table>
		<div class="importe_total_izquierda">
			<p><?php echo $row['montReciText'] ?> CON 00/100 SOLES</p>
		</div>
		<div class="importe_total_derecha">
			<p>Importe total: S/.<?php echo number_format($row['montReci'], 2) ?></p>
		</div>
		<br>
		<div id="info_adicional">
			<p><strong>Observaciones</strong></p>
			<p>CUENTA CORRIENTE SOLES BCP: 000-0000000-0-00 / ECONOCABLE PERÚ</p>
			<p>ENVIAR FOTO DEL VOUCHER AL WSP 950 078 660</p>
			<p>EL CORTE DEL SERVICIO SE REALIZARA 10 DIAS DESPUES DE LA FECHA, PAGUE A TIEMPO</p>
			<p><strong>El recibo número, <?php echo $row['numeReci'] ?> ha sido emitida.</strong></p>
		</div>
</body>
<script>
	// Obtener la fecha y hora actual
	var fechaHoraActual = new Date();

	// Formatear la fecha
	var optionsFecha = {
		year: 'numeric',
		month: '2-digit',
		day: '2-digit'
	};
	var fechaFormateada = fechaHoraActual.toLocaleDateString('es-ES', optionsFecha);

	// Formatear la hora
	var optionsHora = {
		hour: '2-digit',
		minute: '2-digit',
		hour12: true
	};
	var horaFormateada = fechaHoraActual.toLocaleTimeString('es-ES', optionsHora);

	// Mostrar la fecha y hora actual en los elementos HTML correspondientes
	document.getElementById('fecha').textContent = 'Fecha: ' + fechaFormateada;
	document.getElementById('hora').textContent = 'Hora: ' + horaFormateada;
</script>

</html>