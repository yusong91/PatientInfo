<label class="align-self-center">@lang('BTSPlace')</label>
<table class="table table-striped display mb-0" id="btsTable">
    <thead>
        <tr>
            <th scope="row">#</th>
            <th scope="row">@lang('time')</th>
            <th scope="row">@lang('date')</th>
            <th scope="row">LatLong</th>
            <th scope="row">@lang('BTSAddress')</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($btsList as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->time }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->lat }},{{ $item->lon }}</td>
                <td>{{ $item->address }}</td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">@lang('NoData')</td>
            </tr>
        @endforelse
    </tbody>
</table>