@extends("layout")
@section("title","Salary")
@section("view")

    <h4 class="text-center font-weight-bold mb-0" style="line-height: 40px">QUẢN LÝ LƯƠNG</h4>
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
                <div class="col-lg-10">
                    <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#salary">Thêm
                        mới
                    </button>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-2">
                    <form action="" method="get">
                        <div class="input-group">

                            <input type="text" name="seach_account" value=""
                                   class="form-control bg-light border-1 small"
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
                    <th>Tên</th>
                    <th>Cấp độ</th>
                    <th>Giá trị</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                @foreach($getAllSalary as $key => $value)
                    @can("view",$value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->level}}</td>
                            @if(isset($value->value))
                                <td>{{number_format($value->value)}} VNĐ</td>
                            @else
                                <td>NULL</td>
                            @endif
                            <td style="width: 5%"><a href="{{route("salary.edit",["id"=>$value->id])}}"
                                                     class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                            <td style="width: 5%"><a href="{{route("salary.delete",["id"=>$value->id])}}"
                                                     onclick="return confirm('are you want to delete?')"
                                                     class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endcan
                @endforeach
            </table>
        </div>
    </div>



@endsection
@include("salary/create")
