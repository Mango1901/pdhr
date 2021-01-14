@extends("layout")
@section("title","TimeSheet")
@section("view")
<div class="">
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">QUẢN LÝ CHẤM CÔNG</h4>
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
                    $('#tennv').show();
                    $('.tennv').show();

                } else {
                    $('#tennv').hide();
                    $('.tennv').hide();
                }
            })
            $('#hide_account2').click(function () {
                if ($('#hide_account2').is(':checked')) {
                    $('#email').show();
                    $('.email').show();
                } else {
                    $('#email').hide();
                    $('.email').hide();
                }
            })

            $('#hide_account3').click(function () {
                if ($('#hide_account3').is(':checked')) {
                    $('#inputdate').show();
                    $('.inputdate').show();
                } else {
                    $('#inputdate').hide();
                    $('.inputdate').hide();
                }
            })

            $('#hide_account4').click(function () {
                if ($('#hide_account4').is(':checked')) {
                    $('#outputdate').show();
                    $('.outputdate').show();
                } else {
                    $('#outputdate').hide();
                    $('.outputdate').hide();
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
            <div class="row">
                <div class="col-lg-9">
                    <form action="{{route("timeSheet.view")}}" method="get">
                        <input type="date" value="{{date("Y-m-d")}}" name="search_by_date">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-2">
                    <form action="{{route("timeSheet.view")}}" method="get">
                        <div class="input-group">

                            <input type="text" name="search_account" value="" class="form-control bg-light border-1 small"
                                   placeholder="Tìm kiếm..." aria-label="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-1 col-md-6">
                    <a href="#" class="btn btn-primary mt-1" style="position: relative;" id="menu" onclick="toggleMenu()"> <i class="fa fa-list"></i></a>
                    <ul class="dropdown-menu pl-2 left" id="menu-box" style="display: none; left: -80px!important;">
                        <li><input type="checkbox" id="hide_account1" class="myCheckbox" checked>Tên nhân viên
                        </li>
                        <li><input type="checkbox" id="hide_account2" class="myCheckbox" checked>Email
                        </li>
                        <li><input type="checkbox" id="hide_account3" class="myCheckbox" checked>Ngày vào</li>
                        <li><input type="checkbox" id="hide_account4" class="myCheckbox" checked>Ngày ra
                        </li>
                    </ul>
                </div>
            </div>


    <table class="table table-bordered table-hover break_word">
        <thead class=bg_tb>
        <tr>
            <th>Id</th>
            <th id="tennv">Tên nhân viên</th>
            <th id="email">Email</th>
            <th id="inputdate">Ngày vào</th>
            <th id="outputdate">Ngày ra</th>
            <th>Action</th>
        </tr>
        </thead>
        @foreach($getAllTimeSheet as $key => $value)
            <form action="{{route("timeSheet.update",["id"=>$value->id])}}" method="post">
                @csrf
        <tr>
            <td>{{$value->id}}</td>
            <td class="tennv">{{$value->Employee->full_name}}</td>
            <td class="email">{{$value->Employee->User->email}}</td>
            <td class="inputdate"><input type="checkbox" {{isset($value->in_date) ? "checked":""}} value="{{date("Y-m-d H:i:s")}}" name="in_date" id="In-date"></td>
            <td class="outputdate"><input type="checkbox" {{isset($value->out_date) ? "checked":""}} value="{{date("Y-m-d H:i:s")}}" name="out_date" id="Out-date"></td>
            <td><button type="submit" class="btn btn-primary" id="check_date">Checked</button></td>
        </tr>
            </form>
        @endforeach
    </table>
        </div>
    </div>
</div>
@endsection
