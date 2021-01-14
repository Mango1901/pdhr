@section("create")
<!--modal them mới-->
<div class="modal fade" id="ensument" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold color_modal">Thêm mới bảo hiểm</h3>
                <button type="button" data-dismiss="modal" class="close">x</button>
            </div>
            <form action="{{route("insurance.create")}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid bg_modal set_heigh">
                        <div class="form-group row pt-3">
                            <label class="col-lg-2">Phần trăm</label>
                            <div class="col-lg-10">
                                <input type="number" step="0.01" name="percent" class="form-control" placeholder="Phần trăm" required>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-lg-2">Ngày</label>
                            <div class="col-lg-10">
                                <input type="date" value="{{date("Y-m-d")}}" name="date" class="form-control" placeholder="Ngày" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Thêm mới">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                </div>
            </form>

        </div>
    </div>
</div>
    @endsection
