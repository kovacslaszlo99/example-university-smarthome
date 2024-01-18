$(document).ready(function(){
	function ido(){
		setTimeout(function() {
			frissites();
			ido();
		}, 10000);
	}
	ido();
	frissites();
	
	$("#button").click(function(){
		frissites();
	});
	
	$(".edit").click(function(){
		save_clcik_active = true;
		$('#ModalCenterCreateLabel').text('Beálliás módosítása');
		var id = $(this).data('id');
		var time_from = $(this).data('timefrom');
		var time_to =  $(this).data('timeto');
		var temp_from = $(this).data('tempfrom');
		var temp_to = $(this).data('tempto');
		var day = $(this).data('day');
		var room = $(this).data('room');
		$("#smid").val(id);
		$("#time_from").val(time_from);
		$("#time_to").val(time_to);
		$("#temp_from").val(temp_from);
		$("#temp_to").val(temp_to);
		$("#day").val(day);
		$("#room").val(room);
		$('#ModalCenterCreate').modal('show');
		$("#save_button").click(function(){
			if(save_clcik_active){
				var time_from = $('#time_from').val();
				var time_to = $('#time_to').val();
				var temp_from = $('#temp_from').val();
				var temp_to = $('#temp_to').val();
				var day = $("#day option:selected").val();
				var room = $("#room option:selected").val();
				var id = $("#smid").val();
				if(time_from.split(':').length < 3){
					time_from += ":00"
				}
				if(time_to.split(':').length < 3){
					time_to += ":00"
				}
				
				$('#ModalCenterCreate').modal('hide');
				$.post("api/set/room_setting_update.php?sensor_type=1&room_type=" + room + "&id=" + id,
					{
						from_value: temp_from,
						to_value: temp_to,
						week_day: day,
						time_start: time_from,
						time_end: time_to
					}, function(data) {
						if(data == "true"){
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').html('A beálliás mentése megtörtént!   <a href="settings.php" class="alert-link">Oldal frissitése.</a>');
							$('#delete_siker').addClass('alert-success');
							$('#delete_siker').addClass('show');
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-success');
							}, 60000);
						}else{
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').text('A beálliás mentése sikertelen!');
							$('#delete_siker').addClass('alert-danger');
							$('#delete_siker').addClass('show');
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-danger');
							}, 5000);
						}
					});
				save_clcik_active = false;
				$('#time_from').val("");
				$('#time_to').val("");
				$('#temp_from').val("");
				$('#temp_to').val("");
				$("#day").val(1);
				$("#room").val(1);
			}
		});
		$("#save_cancel_button").click(function(){
			$('#ModalCenterCreate').modal('hide');
			$('#time_from').val("");
			$('#time_to').val("");
			$('#temp_from').val("");
			$('#temp_to').val("");
			$("#day").val(1);
			$("#room").val(1);
		});
		$(".close").click(function(){
			$('#ModalCenterCreate').modal('hide');
			$('#time_from').val("");
			$('#time_to').val("");
			$('#temp_from').val("");
			$('#temp_to').val("");
			$("#day").val(1);
			$("#room").val(1);
		});
	});
	
	$("#add").click(function(){
		save_clcik_active = true;
		$('#ModalCenterCreateLabel').text('Új beálliás létherhozása');
		$('#ModalCenterCreate').modal('show');
		$("#save_button").click(function(){
			if(save_clcik_active){
				var time_from = $('#time_from').val();
				var time_to = $('#time_to').val();
				var temp_from = $('#temp_from').val();
				var temp_to = $('#temp_to').val();
				var day = $("#day option:selected").val();
				var room = $("#room option:selected").val();
				
				$('#ModalCenterCreate').modal('hide');
				$.post("api/set/room_setting_insert.php?sensor_type=1&room_type=" + room,
					{
						from_value: temp_from,
						to_value: temp_to,
						week_day: day,
						time_start: time_from + ":00",
						time_end: time_to + ":00"
					}, function(data) {
						if(data == "true"){
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').html('A beálliás mentése megtörtént!   <a href="settings.php" class="alert-link">Oldal frissitése.</a>');
							$('#delete_siker').addClass('alert-success');
							$('#delete_siker').addClass('show');
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-success');
							}, 60000);
						}else{
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').text('A beálliás mentése sikertelen!');
							$('#delete_siker').addClass('alert-danger');
							$('#delete_siker').addClass('show');
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-danger');
							}, 5000);
						}
					});
				save_clcik_active = false;
				$('#time_from').val("");
				$('#time_to').val("");
				$('#temp_from').val("");
				$('#temp_to').val("");
				$("#day").val(1);
				$("#room").val(1);
			}
		});
		$("#save_cancel_button").click(function(){
			$('#ModalCenterCreate').modal('hide');
			$('#time_from').val("");
			$('#time_to').val("");
			$('#temp_from').val("");
			$('#temp_to').val("");
			$("#day").val(1);
			$("#room").val(1);
		});
		$(".close").click(function(){
			$('#ModalCenterCreate').modal('hide');
			$('#time_from').val("");
			$('#time_to').val("");
			$('#temp_from').val("");
			$('#temp_to').val("");
			$("#day").val(1);
			$("#room").val(1);
		});
	});
	
	$(".del").click(function(){
		delete_clcik_active = true;
		var sid = $(this).data('id');
		var text_data = $(this).data('text');
		var day = $(this).data('day');
		var room = $(this).data('room');
		$(".modal-body #sid").val( sid );
		var name = "Biztosan törölni szeretné?<br /><p>" + days[day] + " - " + room + ": " + text_data + "</p>";
		$(".modal-body #name").html(name);
		$('#exampleModalCenter').modal('show');
		$("#delete_cancel_button").click(function(){
			$('#exampleModalCenter').modal('hide');
		});
		$(".close").click(function(){
			$('#exampleModalCenter').modal('hide');
		});
		$("#delete_button").click(function(){
			if(delete_clcik_active){
				var id = $("#sid").val();
				$.get("api/set/room_setting_delete.php", { id: id },
					function(data){
						if(data == "true"){
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').text('A törlés sikerült!');
							$('#delete_siker').addClass('alert-success');
							$('#delete_siker').addClass('show');
							$('#s_' + id).remove()
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-success');
							}, 5000);
						}else{
							$('#exampleModalCenter').modal('hide');
							$('#delete_siker').text('A törlés nem sikerült!');
							$('#delete_siker').addClass('alert-danger');
							$('#delete_siker').addClass('show');
							setTimeout(function() {
								$('#delete_siker').removeClass('show');
								$('#delete_siker').removeClass('alert-danger');
							}, 5000);
						}
				});
				delete_clcik_active = false;
			}
		});
	});
});

var days = {"monday": "Hétfő", "tuesday": "Kedd", "wednesday": "Szerda", "thursday": "Csütörtök", "friday": "Péntek", "saturday": "Szombat", "sunday": "Vasárnap"};
var delete_clcik_active = false;
var save_clcik_active = false;
var szoveg = ["Hömérséklet: ", "Páratartalom: ", "Légnyomás: "];
var mertekegyseg = ["°C", "%", "hPa"];
var interval = [[15, 28], [1, 99], [990, 1100]];

function frissites(){
	for (j = 1; j < 4; j++){
			for (i = 1; i < 7; i++) {
				sensor_new_value(j, i);
				get_aktuator(j, i);
			}
		}
}

function value_update(sensor, room, value){
	var id = "#" + room + "_" + sensor;
	$(id).html(szoveg[sensor-1] + value + mertekegyseg[sensor-1]);
}

function sensor_get_last_value(sensor, room){
	$.get("api/get/sensor_values.php", { sensor_type: sensor, room_type: room, limit: 1 },
		function(data){
			var array = JSON.parse(data);
			value_update(sensor, room, array[0]["value"]);
		});
}

function aktuator_update(sensor, room, value){
	var id = "#" + room + "_" + sensor + "_ak";
	$(id).html(value);
}

function get_aktuator(sensor, room){
	$.get("api/get/aktuator.php", { sensor_type: sensor, room_type: room, from: interval[sensor-1][0] , to: interval[sensor-1][1]},
		function(data){
			aktuator_update(sensor, room, data);
		});
}

function sensor_new_value(sensor, room){
	$.get("api/get/new_sensor_value.php?room_type=" + room + "&sensor_type=" + sensor + "&from=" + interval[sensor-1][0] + "&to=" + interval[sensor-1][1],
    function(data,status){
		$.post("api/set/sensor_value_insert.php?sensor_type=" + sensor + "&room_type=" + room,
		  {
			sensor_value: data
		  });
		  sensor_get_last_value(sensor, room);
    });
	
}