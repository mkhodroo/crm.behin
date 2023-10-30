@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="card p-4">
            <button onclick="new_agency()" class="btn btn-primary col-sm-1">{{ __('New') }}</button>
        </div>
        <div class="card p-4">
            <table>
            <form action="javascript:void(0)" id="filter-form1" class="col-sm-12 table-responsive">
                <td>{{ __(config('agency_info.main_field_name')) }}</td>
                <td>
                    <select name="{{config('agency_info.main_field_name')}}" id="" class="form-control">
                        <option value="">{{ __('All') }}</option>
                        @foreach (config('agency_info.customer_type') as $catagory => $catagory_detail)
                            <option value="{{ $catagory }}">{{ $catagory_detail['name'] }}</option>
                        @endforeach
                    </select>
                </td>
                
            
                <td>
                    <input type="text" name="field_value" id="" class="form-control"
                        placeholder="{{ __('Everything') }}">
                </td>
                <td>
                    <button onclick="filter()" class="btn btn-primary">{{ __('Filter') }}</button>
                </td>
            </table>
            </form>
        </div>
        <div class="card p-4">
            <table class="table table-stripped" id="infos">
                <thead>
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('file number') }}</th>
                        <th>{{ __('firstname') }}</th>
                        <th>{{ __('lastname') }}</th>
                        <th>{{ __(config('agency_info.main_field_name')) }}</th>
                        <th>{{ __('catagory') }}</th>
                        <th>{{ __('national id') }}</th>
                        <th>{{ __('province') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('created at') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        send_ajax_get_request(
            "{{ route('agencyInfo.list') }}",
            function(res) {
                console.log(res);
            }
        )
        var table = create_datatable(
            "infos",
            "{{ route('agencyInfo.list') }}",
            [{
                    data: 'id'
                },
                {
                    data: 'file_number',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'firstname',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'lastname',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: "{{config('agency_info.main_field_name')}}",
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'catagory',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'national_id',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'province_detail',
                    render: function(province_detail) {
                        if (province_detail) {
                            return `${province_detail.province} - ${province_detail.city}`;
                        }
                        return '';
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'created_at',
                    render: function(created_at) {
                        return created_at.split("T")[0];
                    }
                }
            ]
        )

        table.on('dblclick', 'tr', function() {
            var data = table.row(this).data();
            console.log(data);
            open_edit_form(data.parent_id, 'info')
            // show_edit_modal(data.id);
        })

        function open_edit_form(parent_id, active_tab){
            url = "{{ route('agencyInfo.editForm', ['parent_id' => 'parent_id']) }}";
            url = url.replace('parent_id', parent_id);
            open_admin_modal(
                url,
                '',
                function(){
                    var tab = $(`#${active_tab}-tab`).attr('class');
                    var tabBody = $(`#${active_tab}`).attr('class');
                    $(`#${active_tab}-tab`).click()
                }
            )
            
        }

        function new_agency() {
            open_admin_modal(
                "{{ route('agencyInfo.createForm') }}"
            )
        }

        function filter() {
            var fd = new FormData($('#filter-form1')[0]);

            send_ajax_formdata_request(
                "{{ route('agencyInfo.filterList') }}",
                fd,
                function(res) {
                    console.log(res);
                    update_datatable(res.data);
                }
            )
        }

    </script>
@endsection
