    <table class="table table-striped mb-4">
        <thead>
            <tr>
                <th scope="row">@lang('Num')</th>
                <th scope="row">@lang('name')</th>
                <th scope="row">@lang('Gender')</th>
                <th scope="row">@lang('Age')</th>
                <th scope="row">@lang('Contacts')</th>
                <th scope="row">@lang('Last Related')</th>
                <th scope="row">@lang('Warning status')</th>
                <th scope="row">@lang('Address')</th>   
            </tr>
        </thead> 
        <tbody>
            @forelse ($patient_related as $item) 
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->name}}</td>
                    <td>{{ $item->sex->value ?? '' }}</td></td>
                    <td>{{$item->age}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{getDateFormat($item->last_date)}}</td>
                    <td>{{$item->risk->value ?? ""}}</td>
                    <td>{{$item->address}}</td>
                </tr>
            @empty 
                <tr class="text-center">
                    <td colspan="9">@lang('NoData')</td>
                </tr>
            @endforelse
        </tbody>
                    
    </table>