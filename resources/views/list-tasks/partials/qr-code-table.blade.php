<label class="align-self-center">@lang('QRPlace')</label>
<table class="table table-striped display mb-0" id="qrTable">
    <thead>
        <tr>
            <th scope="row">@lang('Num')</th>
            <th scope="row" class="text-nowrap">@lang('date')</th>
            <th scope="row">@lang('ShopName')</th>
            <th scope="row" class="text-right">@lang('ShopPhone')</th>
            <th scope="row" width="100px">@lang('ShopEmail')</th>
            <th scope="row">@lang('commune')</th>
            <th scope="row">@lang('district')</th>
            <th scope="row">@lang('province')</th>
            <th scope="row">@lang('scanResult')</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($qrCodeList as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-nowrap">{{ $item->date }}</td>
                <td>{{ $item->name }}</td>
                <td class="text-right">{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->commune }}</td>
                <td>{{ $item->district }}</td>
                <td>{{ $item->province }}</td>
                <td>{{ $item->result }}</td>
            </tr>
        @empty					
            <tr class="text-center">
                <td colspan="9">@lang('NoData')</td>
            </tr>
        @endforelse
    </tbody>
</table>