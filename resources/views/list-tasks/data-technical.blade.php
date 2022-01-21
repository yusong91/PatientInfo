@extends('layouts.app')

@section('content')
<style>
	.custom-file-label::after {
		content: none !important;
	}
</style>
<section>
	<nav aria-label="Page breadcrumb">
		<ol class="breadcrumb form-steps col-md-10 mx-auto">
			<div class="line"></div>
			<li class="breadcrumb-item"><span>1</span>@lang('PatientInfo')</li>
			<li class="breadcrumb-item"><span>2</span>@lang('FirstInterview')</li>
			<li class="breadcrumb-item active" aria-current="page"><span>3</span>@lang('TechnicalInfo')</li>
			<li class="breadcrumb-item"><span>4</span>@lang('FullInterview')</li>
		</ol>
	</nav>

	<form method="POST" action="{{ route('list-tasks.attach-file') }}" enctype="multipart/form-data" accept-charset="UTF-8">
		@csrf
		<label>@lang('TechnicalLocation')</label>
		<div id="map" style="height: 600px; withd: auto;" class="embed-responsive embed-responsive-21by9 bg-light my-3"></div>
		
		<input type="hidden" name="patient_id" value="{{ $patient->id }}">
		<div class="row justify-space-between">
			<div class="col-md-5 mb-5 mt-5">
				<div class="input-group ml-auto w-auto">
					<div class="custom-file border-right-0 rounded-0">
						<input type="file" name="file_bts" id="bts" class="form-control border-right-0 rounded-0 custom-file-input">
						<label class="custom-file-label border-right-0 rounded-0" for="bts">Excel BTS</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-primary border-primary" type="button" id="button-addon2">@lang('document')</button>
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-4 mt-5">
				<div class="input-group ml-auto w-auto">
					<div class="custom-file border-right-0 rounded-0">
						<input type="file" name="file_qrcode" id="qrplace" class="form-control border-right-0 rounded-0 custom-file-input" >
						<label class="custom-file-label border-right-0 rounded-0" for="qrplace">Excel QRCode</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-primary border-primary" type="button" id="button-addon2">@lang('document')</button>
					</div>
				</div>
			</div>
			<div class="col-md-2 mb-4 mt-5 text-right">
				<button type="submit" class="btn btn-primary px-4 btn-block">@lang('submit')</button>
			</div>
		</div>
	</form> 

	@include('list-tasks.partials.bts-table', ['btsList' => $patient->getAttachBts])
	<div class="my-4"></div>
	@include('list-tasks.partials.qr-code-table', ['qrCodeList' => $patient->getAttachQrCode])
</section>

@stop

@section('scripts')
<script>
	$('#checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date').datepicker({
			uiLibrary: 'bootstrap4'
	});
</script>
<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1sWq9jxeXFjtRz0VYFBdbye5-RVnuXJw&callback=getMap" >
</script>

<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>

<script src="{{url('assets/js/datatables.min.js')}}"></script>
<script>
	$(document).ready(function() {
		$('#btsTable').DataTable( {
				"scrollY": "500px",
				"scrollCollapse": true,
				"paging": false,
				"sort": false,
				"searching": false,
		} );
		$('#qrTable').DataTable( {
				"scrollY": "500px",
				"scrollCollapse": true,
				"paging": false,
				"sort": false,
				"searching": false,
		} );
	});
</script>



<script>
    var map;

	var infowindow = [];

	var list_markers = [];

	var bounds;

	var marker, i;

	var patient = <?php echo collect($patient->getAttachBts); ?>

	var locations = Object.values(patient);

	console.log(locations);

    function getMap() { 

            map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 17,
                  scaleControl: true,
                  center: new google.maps.LatLng(11.575055,104.923053),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
            });

			bounds = new google.maps.LatLngBounds();

			for (i = 0; i<locations.length; i++) {

				list_markers[i] = new google.maps.Marker({
                      position: new google.maps.LatLng(locations[i].lat, locations[i].lon),
                      map: map,
                      store_id: i
                });

				infowindow[i] = new google.maps.InfoWindow({

					content:'<div id="content">' + "Date: " + locations[i].date + 

							'</br>' + "Time: " + locations[i].time +

							'</br>' + "Latitude: " + locations[i].lat +

							'</br>' + "Longitude: " + locations[i].lon +

							'</br>' + "Address BTS: " + locations[i].address +

							'</div>'
				});

				google.maps.event.addListener(list_markers[i], 'click', (function(list_marker,i) {
                  
                  return  function() {    

                            infowindow[i].open(map, list_marker);

                            list_markers[i].setZIndex(list_markers.length);
                          }

                })(list_markers[i], i));

				bounds.extend(list_markers[i].getPosition());

                map.fitBounds(bounds);

			}
    
    }


</script>
<script>
	$('#checkinDate, #dob,#symptomDate, #arrivedDate, #testDate, #vaccine1Date, #vaccine2Date, #vaccine3Date').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'dd/mm/yyyy'
	});
</script>
<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1sWq9jxeXFjtRz0VYFBdbye5-RVnuXJw&callback=getMap" >

</script>


@stop
