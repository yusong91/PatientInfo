<table class="table table-striped mb-4">
    <thead>
        <tr>
            <th scope="row">@lang('Num')</th>
            <th scope="row">@lang('name')</th>
            <th scope="row">@lang('Gender')</th>
            <th scope="row">@lang('Age')</th>
            <th scope="row">@lang('PatientAs')</th>
            <th scope="row">@lang('MultiContacts')</th>
            <th scope="row">@lang('Last Related')</th>
            <th scope="row">@lang('Test result')</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patient_family as $item) 
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$item->name}}</td>
                <td>{{ $item->sex->value ?? '' }}</td></td>
                <td>{{$item->person_age}}</td>

                <td>
                        @foreach ($family_member as $member)

                            @if($item->family_member == $member->id)
                                {{ $member->value }} @break
                            @endif

                        @endforeach    
                </td>

                <td>{{$item->phone}}{{ $item->second_phone != null ? '/' : '' }}{{$item->second_phone}}</td>
                <td>{{getDateFormat($item->last_touch_date)}}</td>
                <td>{{ $item->result->value ?? '' }}</td></td>
            </tr>

        @empty 
            <tr class="text-center">
                <td colspan="9">@lang('NoData')</td>
            </tr>
        @endforelse
    </tbody>
</table>