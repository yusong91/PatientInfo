
@extends('list-tasks.master.main')


@section('content')
   <div class="bg-white px-3 pb-3">
      <table class="table table-striped mb-0">
         <thead class="thead-dark table-header">
            <tr>
               <th scope="col">ល.រ</th>
               <th scope="col">លេខកូដ</th>
               <th scope="col">ឈ្មោះអ្នកជម្ងឺ</th>
               <th scope="col">លេខទូរសព្ទ</th>
               <th scope="col">ខេត្ត/រាជធានី</th>
               <th scope="col">
                  <div class="d-flex">
                     មន្ទីរពេទ្យ
                     <a href="{{ route('patients.excel') }}" class="btn ml-auto py-1" value="Export" target="_blank" style="border: 1px solid #fff"><i class="fa fa-download text-white" aria-hidden="true"></i></a>
                  </div>
               </th>
            </tr>
         </thead>
         <tbody>
            @if (count($patients))
               @foreach ($patients as $item)
                  <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $item->code }}</td>
                     <td>
                        @permission('patients.work')
                           
                           @if($role_id==4)

                              <a href="{{ route('interview',['id'=>$item->id]) }}">{{ $item->name }} </a>

                           @elseif($role_id==5)

                              <a href="{{ route('list-tasks.show',['id'=>$item->id]) }}">{{ $item->name }} </a>

                           @elseif($role_id==6)

                              <a href="{{ route('list-tasks.show', $item->id) }}">{{ $item->name }}</a>

                           @elseif($role_id==9)

                              <a href="{{ route('list-tasks.research.show', $item->id) }}">{{ $item->name }}</a>

                           @endif

                        @endpermission
                     </td>
                     <td>{{ $item->phone }}</td>
                     <td>{{ $item->address }}</td>
                     <td>{{ $item->laboratory_collector}}</td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="6"><em>@lang('app.no_records_found')</em></td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>

@endsection
