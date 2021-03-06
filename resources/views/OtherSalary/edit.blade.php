@extends("layout")
@section("title","OtherSalary")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa lương khác</h4>
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

    <form action="{{route("OtherSalary.update",["id"=>$getEditOtherSalary->id])}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="container-fluid bg_modal set_heigh">
                <div class="form-group row pt-3">
                    <label class="col-lg-2">Tên</label>
                    <div class="col-lg-10">
                        <input type="text" name="name" value="{{$getEditOtherSalary->name}}" class="form-control" placeholder="Tên" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Số Tiền</label>
                    <div class="col-lg-10">
                        <input type="text" name="money" value="{{$getEditOtherSalary->money}}" class="form-control" placeholder="Số Tiền" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Loại</label>
                        <div class="col-lg-10">
                            <select style="width: 100%;" name="type" id="Type" class="form-control input-sm m-bot15 choose_type_other_salary" required="">
                                @if($getEditOtherSalary->type == 0)
                                    <option value="{{$getEditOtherSalary->type}}">Choose from other salary</option>
                                    <option value="1">Not choose from other salary</option>
                                @else
                                    <option value="{{$getEditOtherSalary->type}}">Not Choose from other salary</option>
                                    <option value="0">Choose from other salary</option>
                                @endif
                            </select>
                        </div>
                    </div>
                <div class="form-group row pb-4">
                    <label class="col-lg-2">Giá trị</label>
                    @if($getEditOtherSalary->type == 0)
                        <div class="col-lg-10" id="value">
                            <input type="number" name="value" value="{{$getEditOtherSalary->value}}" class="form-control pt-3" placeholder="Value" required>
                        </div>
                    @else
                        <div class="col-lg-10" id="value">
                            <input type="number" name="value" readonly value="{{$getEditOtherSalary->value}}" class="form-control pt-3" placeholder="Value" required>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <input type="submit" class="btn btn-primary" value="Sửa">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
        </div>
    </form>

@endsection
