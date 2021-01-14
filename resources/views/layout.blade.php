<!--Còn phần chi tiêt từng bảng-->
<!DOCTYPE html>
<html lang="en">
@include("layout/head-css")
<body class="bg-light">
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
    .set_heigh select{
        margin-bottom: 5px!important;
    }
    .set_lineheigh{
        line-height: 40px;
    }
    .break_word tr td{
        word-break: break-word!important;
    }
</style>
<div class="container-fluid">
    @include("layout/header")
</div>
    <div class="container-fluid">
        @yield("view")
    </div>
        @yield("create")
{{--        @yield("edit")--}}

</body>
<script>
    $(function () {
        $('#UserId').select2();
        $('#SalaryId').select2();
        $('#InsuranceId').select2();
        $('#departmentId').select2();
        $('#OtherSalaryId').select2();
        $('#Type').select2();

        $('.choose_salary').change(function () {
            var action = $(this).attr('id');
            var salary_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action == 'SalaryId') {
                result = 'SalaryValue';
            }
            $.ajax({
                url: '{{route("employee.print")}}',
                method: 'POST',
                data: {action: action, salary_id: salary_id, _token: _token},
                success: function (data) {
                    $('#' + result).html(data);
                    console.log(data);
                }
            });
        })
        $('.choose_type').change(function () {
            var action = $(this).attr('id');
            var type = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            var result1 = "";
            if (action == 'Type') {
                result = 'value';
                result1 = "level";
            }
            $.ajax({
                url: '{{route("salary.print")}}',
                method: 'POST',
                data: {action: action, type: type, _token: _token},
                success: function (data) {
                    $('#' + result).html(data);
                    console.log(data);
                }
            });
            $.ajax({
                url: '{{route("salary.print_level")}}',
                method: 'POST',
                data: {action: action, type: type, _token: _token},
                success: function (data) {
                    $('#' + result1).html(data);
                    console.log(data);
                }
            });
        });
        $('.choose_type_other_salary').change(function () {
            var action = $(this).attr('id');
            var type = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action == 'Type') {
                result = 'value';
            }
            $.ajax({
                url: '{{route("OtherSalary.print")}}',
                method: 'POST',
                data: {action: action, type: type, _token: _token},
                success: function (data) {
                    $('#' + result).html(data);
                    console.log(data);
                }
            });
        })
        $('.check-NULL').change(function () {
            var action = $(this).attr('id');
            var other_salary_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action == 'checkNull') {
                result = 'printValue';
            }
            $.ajax({
                url: '{{route("report.print")}}',
                method: 'POST',
                data: {action: action, other_salary_id: other_salary_id, _token: _token},
                success: function (data) {
                    $('#' + result).html(data);
                    console.log(data);
                }
            });
        })
    });
</script>
</html>
