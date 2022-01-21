@extends('layouts.app')

@section('page-title', __('Dashboard'))
@section('page-heading', __('Dashboard'))

@section('styles')
		<style>
			.tbl-info {
				border-bottom-left-radius: .5rem;
				border-bottom-right-radius: .5rem;
			}
			.tbl-info thead th:first-child {
				border-top-left-radius: .5rem;
				color: #fff;
			}
			.tbl-info thead th:last-child {
				border-top-right-radius: .5rem;
				color: #fff;
			}
			.tbl-info tbody td:first-child {
				border-bottom-left-radius: .5rem;
			}
			.tbl-info tbody td:last-child {
				border-bottom-right-radius: .5rem;
			}
			.tbl-info td {
				vertical-align: top !important;
			}
			.user-list li {
				margin-bottom: .5rem;
			}
			.user-list li::before {
				content: "-";
				/* display: inline-block; */
				margin-right: 10px;
			}
		</style>
@stop

@section('content')

<div class="row">
	<div class="col-md-6">
		<table class="table tbl-info table-light shadow">
			<thead class="bg-primary">
				<tr>
					<th>
						ចំនួនកូនក្រុម (8)
					</th>
					<th>
						អ្នកជំងឺបានសម្ភាស៍
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<ul class="user-list list-unstyled">
							<li>Chakara Chan</li>
							<li>Chamroeun Bona</li>
							<li>Davuth Da</li>
							<li>Darany Bona</li>
							<li>Akara Davi</li>
						</ul>
					</td>
					<td>
						<ul class="list-unstyled">
							<li>100 នាក់</li>
							<li>50 នាក់</li>
							<li>150 នាក់</li>
							<li>110 នាក់</li>
							<li>130 នាក់</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-6"></div>
</div>

<!-- add table here -->


@stop