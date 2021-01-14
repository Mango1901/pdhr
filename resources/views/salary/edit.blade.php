@extends("layout")
@section("title","Salary")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa lương</h4>
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

    <form action="{{route("salary.update",["id"=>$getEditSalary->id])}}" method="post">
    @csrf
    <div class="modal-body">
        <div class="container-fluid bg_modal set_heigh">
            <div class="form-group row pt-3">
                <label class="col-lg-2">Tên</label>
                <div class="col-lg-10">
                    <input type="text" name="name" value="{{$getEditSalary->name}}" class="form-control" placeholder="Tên" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2">Loại</label>
                <div class="col-lg-10">
                    <select style="width: 100%;" name="type" id="Type" class="form-control input-sm m-bot15 choose_type" required="">
                        @if($getEditSalary->type == 0)
                            <option value="{{$getEditSalary->id}}">Choose from salary</option>
                            <option value="1">Not choose from salary</option>
                        @else
                            <option value="{{$getEditSalary->id}}">Not choose from salary</option>
                            <option value="0">Choose from salary</option>
                        @endif
                    </select>
                </div>
            </div>
            @if($getEditSalary->type == 0)
            <div class="form-group row">
                <label class="col-lg-2">Cấp độ</label>
                <div class="col-lg-10" id="level">
                    <input type="number" name="level" value="{{$getEditSalary->level}}" class="form-control" placeholder="Cấp độ" required>
                </div>
            </div>
            <div class="form-group row pb-4">
                <label class="col-lg-2">Giá trị</label>
                <div class="col-lg-10" id="value">
                    <input type="number" name="value" value="{{$getEditSalary->value}}" class="form-control" placeholder="Giá trị" required>
                </div>
            </div>
            @else
                <div class="form-group row">
                    <label class="col-lg-2">Cấp độ</label>
                    <div class="col-lg-10" id="level">
                        <input type="number" name="level" readonly value="{{$getEditSalary->level}}" class="form-control" placeholder="Cấp độ" required>
                    </div>
                </div>
                <div class="form-group row pb-3">
                    <label class="col-lg-2">Giá trị</label>
                    <div class="col-lg-10" id="value">
                        <input type="number" name="value" readonly value="{{$getEditSalary->value}}" class="form-control" placeholder="Giá trị" required>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <div class="modal-footer justify-content-center">
        <input type="submit" class="btn btn-primary" value="Sửa">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
    </div>
</form>

@endsection
