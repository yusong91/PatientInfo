<table class="table table-striped mb-4">
    <thead>
        <tr>
            <th scope="row">@lang('Num')</th>
            <th scope="row">@lang('LocationName')</th>
            <th scope="row">@lang('Time')</th>
            <th scope="row">@lang('StartDate')</th>
            <th scope="row">@lang('EndDate')</th>
            <th scope="row">@lang('Address')</th>
        </tr>
    </thead>  
    <tbody>
        @forelse ($patient_travel as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->location_name }}</td>
                <td>{{ $item->time }}</td> 
                <td>{{ getDateFormat($item->start_date) }}</td>
                <td>{{ getDateFormat($item->date) }}</td>
                <td>{{ $item->address }}</td>          
            </tr>
        @empty 
            <tr class="text-center">
                <td colspan="9">@lang('NoData')</td>
            </tr>
        @endforelse
                       
    </tbody>
                
</table>