<div class="row">
    <div class="container-fluid bgr_nav">
        <div class="row">
            <div class="col-lg-2 col-md-12 text-center"> <a href="#">
                    <img src="http://bbq.dhi.mybluehost.me/congtyphuongdong.vn/wp-content/uploads/2019/10/logo-1024x324.png" width="130" height="60">
                </a></div>

        <nav class="col-lg-7 col-md-10 pr-0 navbar navbar-expand-lg justify-content-center">
            <div class="container-fluid">
                <ul class="nav color mr-auto ml">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("user.view")}}">Người dùng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("employee.view")}}">Nhân viên</a>
                    </li>
                    @can("is-admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("report.view")}}">Báo cáo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("timeSheet.view")}}">Bảng chấm công</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("salary.view")}}">Lương</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("OtherSalary.view")}}">Lương khác</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("insurance.view")}}">Bảo hiểm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("department.view")}}">Phòng ban</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("rewards.view")}}">Phần thưởng</a>
                    </li>
                    @endcan
                </ul>

            </div>

        </nav>
    <div class="col-lg-3 col-md-2 text-right mt-3">
{{--        <a href="{{route("login")}}" class="mr-4">Đăng Ký</a>--}}
        <a href="{{route("logout")}}">Đăng xuất</a>
    </div>
</div>
    </div>
</div>
