@section("create")
    <!--modal them mới-->
    <div class="modal fade" id="salary" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold color_modal">Thêm mới lương</h3>
                    <button type="button" data-dismiss="modal" class="close">x</button>
                </div>
                <form action="{{route("salary.create")}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid bg_modal set_heigh">
                            <div class="form-group row pt-3">
                                <label class="col-lg-2">Tên</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" placeholder="Tên" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Loại</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="type" id="Type" class="form-control input-sm m-bot15 choose_type" required="">
                                        <option value="">Chọn loại</option>
                                        <option value="0">Chon từ lương</option>
                                        <option value="1">Không chọn từ lương</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Cấp độ</label>
                                <div class="col-lg-10" id="level"></div>
                            </div>
                            <div class="form-group row pb-4">
                                <label class="col-lg-2">Giá trị</label>
                                <div class="col-lg-10" id="value"></div>
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
