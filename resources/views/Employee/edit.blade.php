@extends("layout")
@section("title","Employee")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa nhân viên</h4>
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
    <form action="{{route("employee.update",["id"=>$getEmployeeById->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="container-fluid bg_modal set_heigh">
                <div class="form-group row pt-3">
                    <label class="col-lg-2">Người dùng</label>
                    <div class="col-lg-10">
                        <select style="width: 100%;" name="user_id" id="UserId" class="form-control input-sm m-bot15 choose_product" required="">
                            <option value="{{$getEmployeeById->user_id}}">{{$getEmployeeById->User->username}}-{{$getEmployeeById->User->email}}</option>
                            @foreach($getEditUser as $key => $value1)
                                <option value="{{$value1->id}}">{{$value1->username}}-{{$value1->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Họ và tên</label>
                    <div class="col-lg-10">
                        <input type="text" name="full_name" value="{{$getEmployeeById->full_name}}" class="form-control" placeholder="First name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Ngày sinh</label>
                    <div class="col-lg-10">
                        <input type="date" name="date_of_birth" value="{{$getEmployeeById->date_of_birth}}" class="form-control" placeholder="Birthday" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Số điện thoại</label>
                    <div class="col-lg-10">
                        <input type="number" name="phone_number" value="{{$getEmployeeById->phone_number}}" class="form-control" placeholder="Phone number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Thẻ căn cước</label>
                    <div class="col-lg-10">
                        <input type="number" name="ID_card" value="{{$getEmployeeById->ID_card}}" class="form-control" placeholder="Thẻ căn cước" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Địa chỉ</label>
                    <div class="col-lg-10">
                        <input type="text" name="address" value="{{$getEmployeeById->address}}" class="form-control" placeholder="Address" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Ảnh đại diện</label>
                    <div class="col-lg-10">
                        <img src="{{asset("storage/".$getEmployeeById->avatar)}}" width="150" height="120"/>
                        <input type="file" name="avatar" accept="image/*" class="" placeholder="Avatar">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Lương</label>
                    <div class="col-lg-10">
                        <select style="width: 100%;" name="salary_id" id="SalaryId" class="form-control input-sm m-bot15 choose_salary" required="">
                            <option value="{{$getEmployeeById->salary_id}}">{{$getEmployeeById->Salary->name}} - {{number_format($getEmployeeById->Salary->value)}}</option>
                            @foreach($getEditSalary as $key => $value2)
                                <option value="{{$value2->id}}">{{$value2->name}} - {{(number_format($value2->value)) ? number_format($value2->value) : "NULL"}}</option>
                            @endforeach
                        </select>
                        OTHER
                        <div id="SalaryValue">
                            @if($getEmployeeById->Salary->type == 0)
                            <input style="font-size: 15px" type="number" readonly name="salary_value" value="{{$getEmployeeById->salary_value}}" />
                            @else
                                <input style="font-size: 15px" type="number" name="salary_value" value="{{$getEmployeeById->salary_value}}" />
                            @endif
                        </div>
                    </div>
                </div>
                @foreach($getEmployeeOtherSalaryByEmployeeId as $key =>$value6)
                    @php
                        $array1[] = $value6->other_salary_id;
                    @endphp
                @endforeach
                <div class="form-group row">
                    <label class="col-lg-2">Lương khác</label>
                    <div class="col-lg-10">
                        <select style="width: 100%;" name="other_salary_id[]" id="OtherSalaryId" class="form-control input-sm m-bot15 " required multiple="multiple">
                            @foreach($getEmployeeOtherSalaryByEmployeeId as $key =>$value6)
                                <option value="{{$value6->other_salary_id}}" {{($value6->employee_id === $getEmployeeById->id) ? 'selected' : '' }}>{{$value6->OtherSalary->name}} - {{$value6->OtherSalary->money}}</option>
                            @endforeach
                            @foreach($getOtherSalary as $getOtherSalaries)
                                <?php $checkOtherSalary = true; ?>
                                @if(isset($array1))
                                <?php $checkOtherSalary = !in_array($getOtherSalaries->id,$array1) ?>
                                @endif
                                @if($checkOtherSalary)
                                    <option value="{{$getOtherSalaries->id}}">{{$getOtherSalaries->name}} - {{$getOtherSalaries->money}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @foreach($getDepartmentByEmployeeId as $key =>$value5)
                    @php
                          $array[] = $value5->department_id;
                    @endphp
                @endforeach
                <div class="form-group row">
                    <label class="col-lg-2">Bộ phận</label>
                    <div class="col-lg-10">
                        <select style="width: 100%;" name="department_id[]" id="departmentId"  class="form-control input-sm m-bot15 " required multiple="multiple">
                          @foreach($getDepartmentByEmployeeId as $key =>$value5)
                            <option value="{{$value5->department_id}}" {{($value5->employee_id === $getEmployeeById->id) ? 'selected' : '' }}>{{$value5->Department->name}}</option>
                            @endforeach
                                @foreach($getAllDepartment as $value4)
                                    @php($checkDepartmentValue = true)
                                        @if(isset($array))
                                      @php($checkDepartmentValue = !in_array($value4->id,$array))
                                          @endif
                                    @if($checkDepartmentValue)
                                        <option value="{{$value4->id}}">{{$value4->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Bảo hiểm</label>
                    <div class="col-lg-10">
                        <select style="width: 100%;" name="insurance_id" id="InsuranceId" class="form-control input-sm m-bot15 choose_product" required="">
                            @if($getEmployeeById->insurance_id == NULL)
                                <option value="0"> Không có bảo hiểm</option>
                            @else
                                <option value="{{$getEmployeeById->insurance_id}}">{{$getEmployeeById->Insurance->percent}} % - {{($getEmployeeById->Insurance->date)}}</option>
                                <option value="0"> Không có bảo hiểm</option>
                            @endif
                            @foreach($getEditInsurance as $key => $value3)
                                <option value="{{$value3->id}}">{{$value3->percent}} % - {{($value3->date)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2">Ngày vào</label>
                    <div class="col-lg-10">
                        <input type="date" name="in_date" value="{{$getEmployeeById->in_date}}" class="form-control" placeholder="In Date" required>
                    </div>
                </div>
                <div class="form-group row pb-4">
                    <label class="col-lg-2">Ngày ra</label>
                    @if($getEmployeeById->out_date == NULL)
                    <div class="col-lg-6">
                        <input type="date" name="out_date" value="{{date("Y-m-d")}}" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label style="font-size: 20px;">NULL</label>
                    </div>
                    <div class="col-lg-1">
                        <input type="checkbox" checked name="out_date_checkbox" value="1" class="" >
                    </div>
                    @else
                        <div class="col-lg-6">
                            <input type="date" name="out_date" value="{{$getEmployeeById->out_date}}" class="form-control">
                        </div>
                        <div class="col-lg-1">
                            <label style="font-size: 20px;">NULL</label>
                        </div>
                        <div class="col-lg-1">
                            <input type="checkbox" name="out_date_checkbox" value="1" class="form-control">
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
