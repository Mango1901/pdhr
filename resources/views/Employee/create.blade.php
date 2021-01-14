@section("create")
    <style>
        .set_heigh input{
            height: 27px;
            font-size: 12px;
            margin-bottom: 5px!important;
        }
        .set_heigh div{
            margin-bottom: 0px!important;
        }
        .form-group label{
            line-height: 24px;
        }
        .btn{
            font-size: 12px;
        }
    </style>
    <div class="modal fade" id="create_employee" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold color_modal">Thêm mới nhân viên</h3>
                    <button type="button" data-dismiss="modal" class="close">x</button>
                </div>
                <form action="{{route("employee.create")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid bg_modal set_heigh">
                            <div class="form-group row pt-3">
                                <label class="col-lg-2">Người dùng</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="user_id" id="UserId" class="form-control input-sm m-bot15 choose_product" required="">
                                        <option value="">Chọn tài khoản</option>
                                        @foreach($getAllUser as $key => $value1)
                                            <option value="{{$value1->id}}">{{$value1->username}}-{{$value1->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Họ tên</label>
                                <div class="col-lg-10">
                                    <input type="text" name="full_name" class="form-control" placeholder="Họ tên" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Ngày sinh</label>
                                <div class="col-lg-10">
                                    <input type="date" name="date_of_birth" value="{{date("Y-m-d")}}" class="form-control" placeholder="Ngày sinh" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Số điện thoại</label>
                                <div class="col-lg-10">
                                    <input type="number" name="phone_number" class="form-control" placeholder="Số điện thoại" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Thẻ căn cước</label>
                                <div class="col-lg-10">
                                    <input type="number" name="ID_card" class="form-control" placeholder="Thẻ căn cước" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Địa chỉ</label>
                                <div class="col-lg-10">
                                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Ảnh đại điện</label>
                                <div class="col-lg-10">
                                    <input type="file" name="avatar" accept="image/*" class="" placeholder="Ảnh đại diện" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Lương</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="salary_id" id="SalaryId" class="form-control input-sm m-bot15 choose_salary" required="">
                                        <option value="">Chọn Mức lương</option>
                                        @foreach($getAllSalary as $key => $value2)
                                            <option value="{{$value2->id}}">{{$value2->name}} - {{number_format($value2->value)}}</option>
                                        @endforeach
                                    </select>
                                    OTHER
                                    <div id="SalaryValue"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Other Salary</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="other_salary_id[]" id="OtherSalaryId" class="form-control input-sm m-bot15 " required multiple="multiple">
                                        @foreach($getAllOtherSalary as $key => $value5)
                                            <option value="{{$value5->id}}">{{$value5->name}} - {{$value5->money}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Bộ phận</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="department_id[]" id="departmentId" class="form-control input-sm m-bot15 " required multiple="multiple">
                                        @foreach($getAllDepartment as $key => $value4)
                                            <option value="{{$value4->id}}">{{$value4->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Bảo hiểm</label>
                                <div class="col-lg-10">
                                    <select style="width: 100%;" name="insurance_id" id="InsuranceId" class="form-control input-sm m-bot15 " required="">
                                        <option value="">Chọn Bảo hiểm</option>
                                        <option value="0">Không có bảo hiểm</option>
                                        @foreach($getAllInsurance as $key => $value3)
                                            <option value="{{$value3->id}}">{{$value3->percent}} % - {{($value3->date)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Ngày vào</label>
                                <div class="col-lg-10">
                                    <input type="date" name="in_date" value="{{date("Y-m-d")}}" class="form-control" placeholder="Ngày vào" required>
                                </div>
                            </div>
                            <div class="form-group row pb-4">
                                <label class="col-lg-2">Ngày ra</label>
                                <div class="col-lg-6">
                                    <input type="date" name="out_date" value="{{date("Y-m-d")}}" class="form-control">
                                </div>
                                <div class="col-lg-1">
                                    <label style="font-size: 20px;">NULL</label>
                                </div>
                                <div class="col-lg-1">
                                    <input type="checkbox" name="out_date_checkbox" value="1">
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
