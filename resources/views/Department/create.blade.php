@section("create")
<!--modal them mới-->
<div class="modal fade" id="department" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold color_modal">Thêm mới phòng ban</h3>
                <button type="button" data-dismiss="modal" class="close">x</button>
            </div>
            <form action="{{route("department.create")}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid bg_modal set_heigh">
                        <div class="form-group row pt-3">
                            <label class="col-lg-2">Tên</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" placeholder="Tên" required>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-lg-2">Mô tả</label>
                            <div class="col-lg-10">
                                <input type="text" name="description" class="form-control" placeholder="Mô tả" required>
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
