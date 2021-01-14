@extends("layout")
@section("title","Insurance")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa bảo hiểm</h4>
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
    <form action="{{route("insurance.update",["id"=>$getEditInsurance->id])}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="container-fluid bg_modal set_heigh">
                <div class="form-group row pt-3">
                    <label class="col-lg-2">Phần trăm</label>
                    <div class="col-lg-10">
                        <input type="number" step="0.01" name="percent" value="{{$getEditInsurance->percent}}" class="form-control" placeholder="Phần trăm" required>
                    </div>
                </div>
                <div class="form-group row pb-3">
                    <label class="col-lg-2">Ngày</label>
                    <div class="col-lg-10">
                        <input type="date" value="{{$getEditInsurance->date}}" name="date" class="form-control" placeholder="Ngày" required>
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
