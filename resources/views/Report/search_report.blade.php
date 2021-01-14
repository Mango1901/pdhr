<div class="row">
    <label class="col-lg-1">Tháng/Năm</label>
    <div class="col-lg-2">
        <input type="month">
    </div>
    <label class="col-lg-1">Từ</label>
    <div class="col-lg-2">
        <input type="month">
    </div>
    <label class="col-lg-1">Tới</label>
    <div class="col-lg-2">
        <input type="month">
    </div>
    <div class="col-lg-2 col-md-4 mb-md-2">
        <form action="{{route("report.view")}}" method="get">
            <div class="input-group">
                <input type="text" name="search_account_report" value="" class="form-control bg-light border-1 small"
                       placeholder="Tìm kiếm tên..." aria-label="Search">
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
            <li><input type="checkbox" id="hide_account1" class="myCheckbox" checked>Họ tên
            </li>
            <li><input type="checkbox" id="hide_account2" class="myCheckbox" checked>Level
            </li>
            <li><input type="checkbox" id="hide_account3" class="myCheckbox" checked>Thời gian
            </li>
            <li><input type="checkbox" id="hide_account4" class="myCheckbox" checked>Lương khác
            </li>
            <li><input type="checkbox" id="hide_account5" class="myCheckbox" checked>Thưởng
            </li>
            <li><input type="checkbox" id="hide_account6" class="myCheckbox" checked>Lương
            </li>
            <li><input type="checkbox" id="hide_account7" class="myCheckbox" checked>Action
            </li>
        </ul>
    </div>
</div>
