<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>SmartHome - Settings</title>
</head>
<body>
<div class="container-fluid">
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Törlési kérelem</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modal">
					<p id="name"></p>
					<input type="hidden" value="" id="sid" />
				</div>
				<div class="modal-footer">
					<button type="button" id="delete_button" class="btn btn-danger">Törlés</button>
					<button type="button" class="btn btn-light" id="delete_cancel_button" data-dismiss="modal">Mégse</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="ModalCenterCreate" tabindex="-1" role="dialog" aria-labelledby="ModalCenterCreateTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalCenterCreateLabel">Új beálliás létherhozása</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modal">
					<input type="hidden" value="" id="smid" />
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="time">Meddől meddig</span>
						</div>
						<input type="time" class="form-control" id="time_from" name="time_from" value="">
						<input type="time" class="form-control" id="time_to" name="time_to" value="">
					</div>
					<br />
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="temp">Hőmérsékleti taromány</span>
						</div>
						<input type="number" step="0.1" class="form-control" id="temp_from" name="temp_from" value="">
						<input type="number" step="0.1" class="form-control" id="temp_to" name="temp_to" value="">
					</div>
					<br />
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="day">Nap</label>
						</div>
						<select class="custom-select" id="day">
							<!--option selected>Choose...</option-->
							<?php
								$days_hu = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap"];
								foreach($days_hu as $day_key => $day){
									echo "<option value='" . $day_key+1 . "'>" . $day . "</option>";
								}
							?>
						</select>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="room">Szoba</label>
						</div>
						<select class="custom-select" id="room">
							<?php
								$rooms = ["Nappali", "Háloszoba", "Előszoba", "Garázs", "Konyha", "Fürdőszoba"];
								foreach($rooms as $room_key => $room){
									echo "<option value='" . $room_key+1 . "'>" . $room . "</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="save_button" class="btn btn-primary">Mentés</button>
					<button type="button" class="btn btn-light" id="save_cancel_button" data-dismiss="modal">Mégse</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-bottom: 20px; margin-top: 20px">
	<nav class="navbar navbar-dark bg-dark">
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link active" href="settings.php">Beállitások</a></li>
		</ul>
	</nav>
	</div>
	<div class="container">
		<div class="card">
			<div class="card-header bg-primary">
				<h2>Ház alap rajz</h2>
			</div>
			<div class="card-body">
				<div class="col-sm-12">
					<img src="image/home.png" class="img-fluid" />
				</div>
			</div>
		</div>
		
		<div class="alert fade" id="delete_siker" role="alert"></div>
		
		<div class="card">
			<div class="card-header bg-primary">
				<h2>Termosztát beállitások</h2>
			</div>
			<div class="card-body">
				<div class="col-sm-12">
					<button type='button' class='btn btn-primary' id='add'>Új beálliás létherhozása</button></p>
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-bs-toggle="tab" href="#monday">Hétfő</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#tuesday">Kedd</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#wednesday">Szerda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#thursday">Csütörtök</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#friday">Pántek</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#saturday">Szombat</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#sunday">Vasárnap</a>
						</li>
					</ul>
					<div class="tab-content">
						<?php
							$days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
							
							foreach($days as $day_key => $day){
								?>
									<div id="<?php echo $day; ?>" class="container tab-pane <?php if($day_key == 0) echo 'active';?>"><br>
										<table border="1" align="center" class="table table-dark">
										<thead>
											<tr>
												<th scope="col">Szoba</th>
												<th scope="col">Termosztát beállitásai</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($rooms as $room_key => $room){
													?>
													<tr>
													<td scope='row'><?php  echo $room;?></td>
													<td>
													<?php
														require_once ("src/DB.php");
														$db = new DB();
														$where = "week_day = " . $day_key + 1 . " and sensor_type_id = 1 and room_type_id = " . $room_key + 1 . " ORDER BY time_start";
														$datas = iterator_to_array($db->getData("*", "rooms_settings", $where), true);
														foreach($datas as $data_key => $data){
															$text = $data['time_start'] . " - " . $data['time_end'] . " => " . $data['from_value'] . "-" . $data['to_value'];
															echo "<p id='s_" . $data['id'] . "'>" . $text .
															" <button type='button' class='btn btn-danger del open-exampleModal' data-room='" . $room . "' data-day='" . $day . "'  data-id='" . $data['id'] . "' data-text='" . $text . "' data-toggle='modal' data-target='#exampleModal'>Törlés</button> ".
															"<button type='button' class='btn btn-primary edit' data-timeFrom='" . $data['time_start'] . "' data-timeTo='" . $data['time_end'] . "' data-tempFrom='" . $data['from_value'] . "' data-tempTo='" . $data['to_value'] . "' data-room='" . $room_key + 1 . "' data-day='" . $day_key + 1 . "' data-id='" . $data['id'] . "'>Szerkesztés</button></p>";
														}
													?>
													</td>
													</tr>
													<?php
												}
											?>
										</tbody>
										</table>
									</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>