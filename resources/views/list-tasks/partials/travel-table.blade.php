<div class="py-3"></div>
<label class="align-self-center">@lang('ListTravelHistory')</label>
<table class="table table-striped" id="traveltable">
    <thead>
        <tr>
            <th scope="row">@lang('Num')</th>
            <th scope="row">@lang('LocationName')</th>
            <th scope="row">@lang('Time')</th>
            <th scope="row">@lang('StartDate')</th>
            <th scope="row">@lang('EndDate')</th>
            <th scope="row">@lang('Address')</th>
            <th scope="row">@lang('Action')</th>
        </tr>
    </thead>  
    <tbody>
        @forelse ($patientTravelList as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->location_name }}</td>
                <td>{{ $item->time }}</td> 
                <td>{{ getDateFormat($item->start_date) }}</td>
                <td>{{ getDateFormat($item->date) }}</td>
                <td>{{ $item->address }}</td>
                <td class="text-center">
                    <div class="dropdown">
                        <button id="my-dropdown" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu" aria-labelledby="my-dropdown">
                            @permission('patient-related.edit')
                                <button class="dropdown-item text-gray" onclick="edit({{ $item->id }})"><i class="fas fa-edit mr-2"></i>@lang('Edit')</button>
                            @endpermission
                            @permission('patient-related.delete')
                                <a data-toggle="modal" data-target="#patientTravelModel-{{$item->id}}" class="dropdown-item text-gray">
                                    <i class="fas fa-trash mr-2"></i>@lang('Delete')
                                </a>
                            @endpermission
                            </div>
                    </div>
                </td>           
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="patientTravelModel-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="patientRelatedModelLabel" aria-hidden="true">
                <form action="{{ route('list-tasks.patienttravel.delete', $item->id) }}">
                    <input type="hidden" name="id" value="{{ $item->id }}" >
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="patientRelatedModelLabel">បញ្ជាក់</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body text-center">តើពិតជាចង់លុប អ្នកប៉ះពាល់នេះមែនទេ?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ទេ</button>
                                <button type="submit" class="btn btn-danger">លុប</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        @empty 
            <tr class="text-center">
                <td colspan="9">@lang('NoData')</td>
            </tr>
        @endforelse
                       
    </tbody>
                
</table>