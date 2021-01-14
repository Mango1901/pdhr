@extends("layout")
@section("title","Report")
@section("view")
<!--Time sheet-->
<h4 class="text-center font-weight-bold mb-0 set_lineheigh">QUẢN LÝ BÁO CÁO</h4>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#hide_account1').click(function () {
            if ($('#hide_account1').is(':checked')) {
                $('#hoten').show();
                $('.hoten').show();

            } else {
                $('#hoten').hide();
                $('.hoten').hide();
            }
        })
        $('#hide_account2').click(function () {
            if ($('#hide_account2').is(':checked')) {
                $('#level').show();
                $('.level').show();
            } else {
                $('#level').hide();
                $('.level').hide();
            }
        })

        $('#hide_account3').click(function () {
            if ($('#hide_account3').is(':checked')) {
                $('#time').show();
                $('.time').show();
            } else {
                $('#time').hide();
                $('.time').hide();
            }
        })

        $('#hide_account4').click(function () {
            if ($('#hide_account4').is(':checked')) {
                $('#luongkhac').show();
                $('.luongkhac').show();
            } else {
                $('#luongkhac').hide();
                $('.luongkhac').hide();
            }
        })

        $('#hide_account5').click(function () {
            if ($('#hide_account5').is(':checked')) {
                $('#thuong').show();
                $('.thuong').show();
            } else {
                $('#thuong').hide();
                $('.thuong').hide();
            }
        })

        $('#hide_account6').click(function () {
            if ($('#hide_account6').is(':checked')) {
                $('#luong').show();
                $('.luong').show();
            } else {
                $('#luong').hide();
                $('.luong').hide();
            }
        })

        $('#hide_account7').click(function () {
            if ($('#hide_account7').is(':checked')) {
                $('#action').show();
                $('.action').show();
            } else {
                $('#action').hide();
                $('.action').hide();
            }
        })

        $('#show').click(function () {
            {
                var menuBox = document.getElementById('menu-box');
                $('td').show();
                $('th').show();
                $('.myCheckbox').prop('checked', true);
                menuBox.style.display = "none";
            }
        })


    })
</script>
<script>
    function toggleMenu() {
        var menuBox = document.getElementById('menu-box');
        if (menuBox.style.display == "none") { // if is menuBox displayed, hide it
            menuBox.style.display = "block";
        } else { // if is menuBox hidden, display it
            menuBox.style.display = "none";
        }
    }
    $(document).ready(function () {

        $("#paginate").change(function () {
            $("select option:selected").each(function () {
                str = $(this).val();
                $("#paginator").val(str);
                var form = $('#form1');
                //$(document.body).append(form);
                form.submit();
            });
        })
    })
</script>
<div class="card">
    <div class="card-body p-2">
      @include("Report/search_report")
        @php($i=0)
        @foreach($getRewards as $getReward)
            @php($i++)
        @endforeach
        @php($j=0)
        @foreach($getOtherSalary as $getOtherSalaries)
            @php($j++)
        @endforeach
        <table class="table table-bordered break_word">
            <tr class="bg_tb">
                <th rowspan="2" style="line-height: 60px;">STT</th>
                <th rowspan="2" style="line-height: 60px;" id="hoten">Họ Tên</th>
                <th rowspan="2" style="line-height: 60px;" id="level">Level</th>
                <th rowspan="2" style="line-height: 60px;" id="time">Thời gian</th>
                @if($j==0)
                    <th colspan="1" class="text-center" id="luongkhac">Lương khác</th>
                @else
                    <th colspan="{{$j}}" class="text-center" id="luongkhac">Lương khác</th>
                @endif
                @if($i==0)
                    <th colspan="1" class="text-center" id="thuong">Thưởng</th>
                @else
                <th colspan="{{$i}}" class="text-center" id="thuong">Thưởng</th>
                @endif
                <th rowspan="2" style="line-height: 60px;" id="luong">Lương</th>
                <th rowspan="2" style="line-height: 60px;" id="action">Action</th>
            </tr>
            <tr class="bg_tb">
                @if($j==0)
                    <th class="luongkhac">Chưa có</th>
                @else
                    @foreach($getAllEmployees as $employees)
                        @foreach($getAllOtherEmployeeSalaryHistory as $value2)
                            @if(($value2->other_salary_id))
                                <?php
                                $checkEmployeeOtherSalaryName = $value2->employee_id;
                                ?>
                                @if($value2->other_salary_id && $value2->employee_id === $employees->id)
                                        @php($arrayEmployeeOtherSalary[] = $value2->other_salary_id)
                                @endif
                            @endif
                        @endforeach
                            @php(\Debugbar::info($arrayEmployeeOtherSalary))
                @endforeach
                        @foreach($getAllOtherEmployeeSalaryHistory as $value2)
                          <?php
                                if(isset($stop)){
                                    if(in_array($value2->other_salary_id,$stop)){
                                    continue;
                                    }
                            }
                        ?>
                            <th class="luongkhac">{{$value2->OtherSalary->name}}</th>
                                      @if(isset($stop))
                                            @php($stop[] = $value2->other_salary_id)
                                      @else
                                          @php($stop[] = $value2->other_salary_id)
                                      @endif
                            @endforeach

                            @foreach($getOtherSalary as $getOtherSalaries)
                            @php($checkExistOtherSalaryName = true)
                            @if(isset($arrayEmployeeOtherSalary))
                                @php($checkExistOtherSalary = !in_array($getOtherSalaries->id,$arrayEmployeeOtherSalary))
                            @endif
                                @if(isset($arrayEmployeeOtherSalary))
                                    @if(!in_array($getOtherSalaries->id,$arrayEmployeeOtherSalary))
                                        <th class="luongkhac">{{$getOtherSalaries->name}}</th>
                                    @endif
                                @else
                                    <th class="luongkhac">{{$getOtherSalaries->name}}</th>
                                @endif
                        @endforeach
                @endif
                    @if($i==0)
                            <th class="thuong">Chưa có</th>
                    @else
                        @foreach($getAllEmployees as $employees)
                            @foreach($getAllEmployeeRewardsHistory as $employeeRewards)
                                @php($check_exist_rewards[] = $employeeRewards->rewards_id)
                            @endforeach
                                @foreach($getAllEmployeeRewardsHistory as $employeeRewards)
                                <?php
                                if(isset($stopRewards)){
                                    if(in_array($employeeRewards->rewards_id,$stopRewards)){
                                        continue;
                                    }
                                }
                                ?>
                                <th class="thuong">{{$employeeRewards->Reward->name}}</th>
                                @if(isset($stopRewards))
                                    @php($stopRewards[] = $employeeRewards->rewards_id)
                                @else
                                    @php($stopRewards[] = $employeeRewards->rewards_id)
                                @endif
                            @endforeach
                        @endforeach
                            @foreach($getRewards as $getReward)
                            @if(isset($check_exist_rewards))
                                @if(!in_array($getReward->id,$check_exist_rewards))
                                    <th class="thuong">{{$getReward->name}}</th>
                                @endif
                            @else
                                <th class="thuong">{{$getReward->name}}</th>
                            @endif
                        @endforeach
                    @endif
            </tr>
            @foreach($getAllEmployees as $getAllEmployee)
                    @php($start_time = \Carbon\Carbon::parse($getAllEmployee->in_date))
                    @if($getAllEmployee->out_date == NULL)
                    @php($end_time = NULL)
                    @else
                        @php($end_time = \Carbon\Carbon::parse($getAllEmployee->out_date))
                    @endif
                @if($end_time == NULL)
                   @php($result = NULL)
                @else
                    @php($result = $start_time->diffInHours($end_time, false))
                @endif
                @php($salary = $getAllEmployee->salary_value)
                <form action="{{route("report.update",["id"=>$getAllEmployee->id])}}" method="post">
                    @csrf
            <tr>
                    <td>{{$getAllEmployee->id}}</td>
                    <td class="hoten"><a href="#" data-toggle="modal" data-target="#profile{{$getAllEmployee->id}}">{{$getAllEmployee->full_name}}</a></td>
                    <td class="level">{{$getAllEmployee->Salary->level}}</td>
                @if($result == NULL)
                    <td class="time"><a href="#" data-toggle="modal" data-target="#time{{$getAllEmployee->id}}">NULL</a></td>
                @else
                    <td class="time"><a href="#" data-toggle="modal" data-target="#time{{$getAllEmployee->id}}">{{$result}}h</a></td>
                @endif
                @if($j==0)
                    <th class="luongkhac">Chưa có</th>
                @else
                    @foreach($getAllOtherEmployeeSalaryHistory as $value2)
                        @if(($value2->other_salary_id) && $value2->employee_id === $getAllEmployee->id)
                       <?php
                        $checkEmployeeOtherSalary = $value2->employee_id;
                        $array5[] = $value2->other_salary_id;
                       ?>
                        @endif
                    @endforeach
                        @php($sumOtherSalary = 0)
                        @foreach($getAllOtherEmployeeSalaryHistory as $value2)
                            @if($value2->employee_id === $getAllEmployee->id)
                                @php($sumOtherSalary += $value2->value)
                            @if($value2->value != 0)
                            <td><input type="checkbox" checked name="other_salary[]" value="{{$value2->other_salary_id}}"/>  {{number_format($value2->value)}} VNĐ</td>
                            @else
                            <td>    <input type="checkbox" checked name="other_salary[]"  value="{{$value2->other_salary_id}}"/> NULL
                                    <input type="number" name="value" class="form-control pt-3" value=""/>
                            </td>
                            @endif
                            @endif
                        @endforeach
                    @foreach($getOtherSalary as $getOtherSalaries)
                        @php($checkExistOtherSalary = true)
                            @if(isset($array5) && $checkEmployeeOtherSalary === $getAllEmployee->id)
                                @php($checkExistOtherSalary = !in_array($getOtherSalaries->id,$array5))
                            @endif
                        @if($checkExistOtherSalary)
                            @if(($getOtherSalaries->value) !=0)
                            <td><input type="checkbox" name="other_salary[]" value="{{$getOtherSalaries->id}}"/> {{number_format($getOtherSalaries->value)}} VNĐ</td>
                            @else
                                    @foreach($getAllOtherEmployeeSalaryHistoryWithStatus as $values1)
                                        @php($checkExists = true)
                                        @if(isset($array) && $checkEmployeeOtherSalary === $getAllEmployee->id)
                                        @php($checkExists = !in_array($values1->other_salary_id,$array))
                                        @endif
                                        @if($checkExists)
                                @if($values1->value == NULL)
                                    <td id="printValue">
                                        <input type="checkbox" name="other_salary[]" id="checkNull" class="" value="{{$values1->other_salary_id}}"/> Chọn
                                        <input type="number" name="value" class="form-control pt-3" value=""/>
                                    </td>
                                @else
                                    <td id="printValue">
                                        <input type="checkbox" name="other_salary[]" id="checkNull" class="" value="{{$values1->other_salary_id}}"/> {{number_format($values1->value)}} VNĐ</td>
                                    </td>
                                @endif
                                         @endif
                                    @endforeach
                            @endif
                        @endif
                    @endforeach
                @endif
                @if($i==0)
                    <th class="thuong">Chưa có</th>
                @else
                    @foreach($getAllEmployeeRewardsHistory as $value3)
                        @if(isset($value3->rewards_id) && ($value3->employee_id === $getAllEmployee->id))
                            <?php
                            $checkEmployeeOtherRewards = $value3->employee_id;
                            $array1[] = $value3->rewards_id;
                            ?>
                        @endif
                    @endforeach
                @php($sumRewards = 0)
                        @foreach($getAllEmployeeRewardsHistory as $value1)
                            @if($value1->employee_id === $getAllEmployee->id)
                            @php($sumRewards += $value1->Reward->value )
                            <td class="thuong"><input type="checkbox" checked name="other_rewards[]" value="{{$value1->rewards_id}}"/>  {{number_format($value1->Reward->value)}} VNĐ</td>
                            @endif
                        @endforeach
                    @foreach($getRewards as $getReward)
                            @php($checkExistRewardsHistory = true)
                            @if(isset($array1) && $checkEmployeeOtherRewards === $getAllEmployee->id)
                                @php($checkExistRewardsHistory = !in_array($getReward->id,$array1))
                            @endif
                        @if($checkExistRewardsHistory)
                        <td class="thuong"><input type="checkbox" name="other_rewards[]" value="{{$getReward->id}}"/>  {{(number_format($getReward->value))}} VNĐ</td>
                        @endif
                    @endforeach
                @endif
                @if(isset($sumOtherSalary) && !isset($sumRewards))
                    <td class="luong">{{number_format($salary + $sumOtherSalary)}} VNĐ</td>
                @elseif(isset($sumRewards) && $sumOtherSalary == NULL)
                    <td class="luong">{{number_format($salary + $sumRewards)}} VNĐ</td>
                @elseif(isset($sumOtherSalary) && isset($sumRewards) )
                <td class="luong">{{number_format($salary + $sumOtherSalary + $sumRewards)}} VNĐ</td>
                @else
                    <td class="luong">{{number_format($salary)}} VNĐ</td>
                @endif
                <td class="action"><button type="submit" class="btn btn-primary">Checked</button></td>
            </tr>
                </form>
            @endforeach
        </table>
    </div>
</div>
@include("Report/modal_time")
@include("Report/modal_profile")
@endsection
