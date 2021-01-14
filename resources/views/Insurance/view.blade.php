@extends("layout")
@section("title","Insurance")
@section("view")
    <!--Ensument-->
    <div class="">
        <h4 class="text-center font-weight-bold mb-0 set_lineheigh">QUẢN LÝ BẢO HIỂM</h4>
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
                            $('#phantram').show();
                            $('.phantram').show();

                        } else {
                            $('#phantram').hide();
                            $('.phantram').hide();
                        }
                    })
                    $('#hide_account2').click(function () {
                        if ($('#hide_account2').is(':checked')) {
                            $('#date').show();
                            $('.date').show();
                        } else {
                            $('#date').hide();
                            $('.date').hide();
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
                    @can("is-admin")
                        <div class="col-lg-9">
                            <button type="button" class="btn btn-primary mb-1 table-light" data-toggle="modal"
                                    data-target="#ensument">Thêm mới
                            </button>
                        </div>
                    @endcan
                        <div class="col-lg-2 col-md-4 mb-md-2">
                            <form action="" method="get">
                                <div class="input-group">

                                    <input type="text" name="seach_account" value="" class="form-control bg-light border-1 small"
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
                                <li><input type="checkbox" id="hide_account1" class="myCheckbox" checked>Phần trăm
                                </li>
                                <li><input type="checkbox" id="hide_account2" class="myCheckbox" checked>Ngày
                                </li>
                            </ul>
                        </div>
                </div>
                <table class="table table-bordered table-hover table-light break_word">
                    <thead class=bg_tb>
                    <tr>
                        <th>Id</th>
                        <th id="phantram">Phần trăm</th>
                        <th id="date">Ngày</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    @foreach($getInsurance as $key => $value)
                        @can("view",$value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td class="phantram">{{$value->percent}} %</td>
                                <td class="date">{{$value->date}}</td>
                                <td style="width: 5%"><a href="{{route("insurance.edit",["id"=>$value->id])}}"
                                                         class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                <td style="width: 5%"><a href="{{route("insurance.delete",["id"=>$value->id])}}"
                                                         class="btn btn-danger"
                                                         onclick="return confirm('Are you want to delete?')"><i
                                                class="fa fa-trash"></i></a></td>
                            </tr>
                        @endcan
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endsection
@include("Insurance/create")
