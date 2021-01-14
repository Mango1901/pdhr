@extends("layout")
@section("title","Rewards")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa phần thưởng</h4>
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
    <form action="{{route("rewards.update",["id"=>$getEditRewards->id])}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="container-fluid bg_modal set_heigh">
                <div class="form-group row pt-3">
                    <label class="col-lg-2">Tên</label>
                    <div class="col-lg-10">
                        <input type="text" name="name" value="{{$getEditRewards->name}}" class="form-control" placeholder="Tên" required>
                    </div>
                </div>
                <div class="form-group row pb-3">
                    <label class="col-lg-2">Giá trị</label>
                    <div class="col-lg-10">
                        <input type="number" name="value" value="{{$getEditRewards->value}}" class="form-control" placeholder="Giá trị" required>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <input type="submit" class="btn btn-primary" value="Sửa">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
        </div>
    </form>
@endsection
