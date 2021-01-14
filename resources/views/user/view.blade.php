@extends("layout")
@section("title","User")
@section("view")
    <div class="">
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">QUẢN LÝ NGƯỜI DÙNG</h4>
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
                    $('#ten').show();
                    $('.ten').show();

                } else {
                    $('#ten').hide();
                    $('.ten').hide();
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
                    $('#vitri').show();
                    $('.vitri').show();
                } else {
                    $('#vitri').hide();
                    $('.vitri').hide();
                }
            })

            $('#hide_account4').click(function () {
                if ($('#hide_account4').is(':checked')) {
                    $('#active').show();
                    $('.active').show();
                } else {
                    $('#active').hide();
                    $('.active').hide();
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
    @can("is-admin")
                <div class="row">
                    <div class="col-lg-9">
                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#create">Thêm mới</button>
                    </div>
                    @endcan
                    <div class="col-lg-2 col-md-4 mb-md-2">
                        <form action="" method="get">
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
                        <a href="#" class="btn btn-primary mt-1" id="menu" onclick="toggleMenu()"> <i class="fa fa-list"></i></a>
                            <ul class="dropdown-menu pl-2" id="menu-box" style="display: none; left: -80px!important;">
                                <li><input type="checkbox" id="hide_account1" class="myCheckbox" checked>Tên người dùng
                                </li>
                                <li><input type="checkbox" id="hide_account2" class="myCheckbox" checked>Email
                                </li>
                                <li><input type="checkbox" id="hide_account3" class="myCheckbox" checked>Vị trí</li>
                                <li><input type="checkbox" id="hide_account4" class="myCheckbox" checked>Hoạt động
                                </li>
                            </ul>
                    </div>
                </div>

    <table class="table table-bordered table-hover table-light break_word">
        <thead class=bg_tb>
        <tr>
            <th>Id</th>
            <th id="ten">Tên người dùng</th>
            <th id="email">Email</th>
            <th id="vitri">Vị trí</th>
            @can("is-admin")
            <th id="active">Hoạt động</th>
            <th colspan="2">Action</th>
            @endcan
        </tr>
        </thead>
        @foreach($getAllUser as $key => $value)
        @if(\Illuminate\Support\Facades\Auth::user()->roles === 1)
       <tr>
           <td><a href="#">{{$value->id}}</a></td>
           <td class="ten">{{$value->username}}</td>
           <td class="email">{{$value->email}}</td>
           <td class="vitri">{{($value->roles == 1) ? "Admin":"User"}}</td>
           @can("is-admin")
           <td class="active">{{($value->active == 1) ? "Onl":"Off"}}</td>
           @endcan
           @if(\Illuminate\Support\Facades\Auth::user()->roles === 1)
               <td style="width: 5%"><a href="{{route("user.edit",["id"=>$value->id])}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
           <td style="width: 5%"><a href="{{route("user.delete",["id"=>$value->id])}}" class="btn btn-danger" onclick="return confirm('Are you want to delete?')"><i class="fa fa-trash"></i></a></td>
           @endif
       </tr>
       @endif
   @endforeach
</table>
            </div>
        </div>
@include("user/create")
{{--    @include("user/edit")--}}
    </div>
@endsection


