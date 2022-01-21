@extends('layouts.app')

@section('styles')
	<style>
		.form-floating .form-control {
			border-radius: 0 0.25rem 0.25rem 0;
		}
	</style>
@endsection
@section('content')

	<div>
		@livewire('patient-import-excel')

	</div>
@stop

@section('scripts')

{{--<script>--}}
{{--	$(".custom-file-input").on("change", function() {--}}
{{--		var fileName = $(this).val().split("\\").pop();--}}
{{--		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);--}}
{{--	});--}}
{{--</script>--}}

@stop