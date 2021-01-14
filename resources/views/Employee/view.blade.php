@extends("layout")
@section("title","Employee")
@section("view")
    <h4 class="text-center font-weight-bold mb-0" style="line-height: 40px">QUẢN LÝ NHÂN VIÊN</h4>
    @if (session('message'))
        <div class="alert alert-success help-block">{{session('message')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger help-block">{{session('error')}}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body p-2">
            <div class="row">
                @can("is-admin")
                    <div class="col-lg-10">
                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal"
                                data-target="#create_employee">Thêm mới
                        </button>
                    </div>
                @endcan
                    <div class="col-lg-2 col-md-4 mb-md-2">
                        <form action="" method="get">
                            <div class="input-group">

                                <input type="text" name="search_account" value="" class="form-control bg-light border-1 small"
                                       placeholder="Tìm kiếm..." aria-label="Search">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

            </div>
            <table class="table table-bordered table-hover table-light break_word">
                <thead class=bg_tb>
                <tr>
                    <th>Id</th>
                    <th>Người dùng</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Thẻ căn cước</th>
                    <th>Địa chỉ</th>
                    <th>Ảnh đại diện</th>
                    <th>Lương</th>
                    <th>Bảo hiểm</th>
                    <th>Ngày vào</th>
                    <th>Ngày ra</th>
                    @can("is-admin")
                        <th colspan="2">Action</th>
                    @endcan
                </tr>
                </thead>
                @foreach($getAllEmployee as $key => $value )
                    @can("view",$value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->User->username}}</td>
                            <td>{{$value->full_name}}</td>
                            <td>{{$value->date_of_birth}}</td>
                            <td>{{$value->phone_number}}</td>
                            <td>{{$value->ID_card}}</td>
                            <td>{{$value->address}}</td>
                            @if(isset($value->avatar))
                                <td><img src="{{asset("storage/".$value->avatar)}}" width="150" height="120"/></td>
                            @else
                                <td>NULL</td>
                            @endif
                            <td>{{number_format($value->salary_value)}} VNĐ</td>
                            @if(isset($value->insurance_id))
                                <td>{{($value->Insurance->percent)}} %</td>
                            @else
                                <td>NULL</td>
                            @endif
                            <td>{{($value->in_date)}}</td>
                            @if(isset($value->out_date))
                                <td>{{($value->out_date)}}</td>
                            @else
                                <td>NULL</td>
                            @endif
                            @can("update",$value)
                                <td style="width: 5%"><a href="{{route("employee.edit",["id"=>$value->id])}}"
                                                         class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                            @endcan
                            @can("delete",$value)
                                <td style="width: 5%"><a href="{{route("employee.delete",["id"=>$value->id])}}"
                                                         class="btn btn-danger"
                                                         onclick="return confirm('Are you want to delete?')"><i
                                                class="fa fa-trash"></i></a></td>
                            @endcan
                        </tr>
                    @endcan
                @endforeach
            </table>
        </div>
    </div>
@endsection
@include("Employee/create")
