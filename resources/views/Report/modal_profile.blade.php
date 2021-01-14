@foreach($getAllEmployees as $getAllEmployee)
    <div class="modal fade" id="profile{{$getAllEmployee->id}}" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold color_modal">Thông tin</h3>
                    <button type="button" data-dismiss="modal" class="close">x</button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="container-fluid bg_modal">
                            <div class="form-group row pt-3">
                                <label class="col-lg-2">Họ tên</label>
                                <div class="col-lg-10">
                                    {{$getAllEmployee->full_name}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Mức lương</label>
                                <div class="col-lg-10">
                                    {{number_format($getAllEmployee->salary_value)}} VNĐ
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Ngày sinh</label>
                                <div class="col-lg-10">
                                    {{$getAllEmployee->date_of_birth}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Số điện thoại</label>
                                <div class="col-lg-10">
                                    {{$getAllEmployee->phone_number}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Địa chỉ</label>
                                <div class="col-lg-10">
                                    {{$getAllEmployee->address}}
                                </div>
                            </div>
                            @foreach($getDepartmentEmployee as $value1)
                                @if(isset($value1))
                                    @if($getAllEmployee->id == $value1->employee_id)
                                        <div class="form-group row">
                                            <label class="col-lg-2">Phòng ban</label>
                                            <div class="col-lg-10">
                                                {{$value1->Department->name}}
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group row">
                                        <label class="col-lg-2">Phòng ban</label>
                                        <div class="col-lg-10">
                                            Chưa có
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="form-group row">
                                <label class="col-lg-2">Thẻ căn cước</label>
                                <div class="col-lg-10">
                                    {{$getAllEmployee->ID_card}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach
