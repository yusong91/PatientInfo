<div class="py-3"></div>
<label class="align-self-center">@lang('FamilyMember')</label>
<table class="table table-striped" id="familytable">
    <thead>
        <tr>
            <th scope="row">@lang('Num')</th>
            <th scope="row">@lang('name')</th>
            <th scope="row">@lang('Gender')</th>
            <th scope="row">@lang('Age')</th>
            <th scope="row">@lang('MultiContacts')</th>
            <th scope="row">@lang('Last Related')</th>
            <th scope="row">@lang('Test result')</th>
            
            <th scope="row">@lang('Action')</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patientFamilyList as $item) 
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$item->name}}</td>
                <td>{{ $item->sex->value ?? '' }}</td></td>
                <td>{{$item->person_age}}</td>
                <td>{{$item->phone}}{{ $item->second_phone != null ? '/' : '' }}{{$item->second_phone}}</td>
                <td>{{getDateFormat($item->last_touch_date)}}</td>
                <td>{{ $item->result->value ?? '' }}</td></td>
                <td class="text-center">
                    <div class="dropdown">
                        <button id="my-dropdown" class="btn btn-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                            <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                @permission('patient-related.edit')
                                    <button class="dropdown-item text-gray" onclick="editFamily({{ $item->id }})"><i class="fas fa-edit mr-2"></i>@lang('Edit')</button>
                                @endpermission
                                @permission('patient-related.delete')
                                    <a data-toggle="modal" data-target="#patientRelatedModel-{{$item->id}}" class="dropdown-item text-gray">
                                        <i class="fas fa-trash mr-2"></i>
                                            @lang('Delete')
                                    </a>
                                @endpermission
                        </div>
                    </div>
                </td>

            </tr>

            <!-- Modal -->
            <div class="modal fade" id="patientRelatedModel-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="patientRelatedModelLabel" aria-hidden="true">
                <form action="{{ route('list-tasks.patientfamily.delete', $item->id) }}">
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