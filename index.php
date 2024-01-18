<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>SmartHome - Home</title>
</head>
<body>
<div class="container-fluid">
	<div class="container" style="margin-bottom: 20px; margin-top: 20px">
	<nav class="navbar navbar-dark bg-dark">
		<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="settings.php">Beállitások</a></li>
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
		
		<div class="card">
			<div class="card-header bg-primary">
				<h2>Szenszor adatok</h2>
			</div>
			<div class="card-body">
				<div class="col-sm-12">
					<p><button id="button" type="button" class="btn btn-primary btn-lg btn-block">Frissités</button></p>
					<table border="1" align="center" class="table table-dark">
						<thead>
							<tr>
								<th scope="col">Szoba</th>
								<th scope="col">Szenzor adatok</th>
								<th scope="col">Aktuátorok álapota</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td scope='row'>Nappali</td>
								<td>
									<p id="1_1"></p>
									<p id="1_2"></p>
									<p id="1_3"></p>
								</td>
								<td>
									<p id="1_1_ak"></p>
									<p id="1_2_ak"></p>
								</td>
							</tr>
							<tr>
								<td scope='row'>Háloszoba</td>
								<td>
									<p id="2_1"></p>
									<p id="2_2"></p>
									<p id="2_3"></p>
								</td>
								<td>
									<p id="2_1_ak"></p>
									<p id="2_2_ak"></p>
								</td>
							</tr>
							<tr>
								<td scope='row'>Előszoba</td>
								<td>
									<p id="3_1"></p>
									<p id="3_2"></p>
									<p id="3_3"></p>
								</td>
								<td>
									<p id="3_1_ak"></p>
									<p id="3_2_ak"></p>
								</td>
							</tr>
							<tr>
								<td scope='row'>Garázs</td>
								<td>
									<p id="4_1"></p>
									<p id="4_2"></p>
									<p id="4_3"></p>
								</td>
								<td>
									<p id="4_1_ak"></p>
									<p id="4_2_ak"></p>
								</td>
							</tr>
							<tr>
								<td scope='row'>Konyha</td>
								<td>
									<p id="5_1"></p>
									<p id="5_2"></p>
									<p id="5_3"></p>
								</td>
								<td>
									<p id="5_1_ak"></p>
									<p id="5_2_ak"></p>
								</td>
							</tr>
							<tr>
								<td scope='row'>Fürdőszoba</td>
								<td>
									<p id="6_1"></p>
									<p id="6_2"></p>
									<p id="6_3"></p>
								</td>
								<td>
									<p id="6_1_ak"></p>
									<p id="6_2_ak"></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>