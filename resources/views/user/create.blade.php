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
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-weight-bold color_modal">Thêm mới người dùng</h3>
                    <button type="button" data-dismiss="modal" class="close">x</button>
                </div>
                <form action="{{route("user.register")}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid bg_modal set_heigh">
                            <div class="form-group row pt-3">
                                <label class="col-lg-2">User name</label>
                                <div class="col-lg-10">
                                    <input type="text" name="username" class="form-control" placeholder="User name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">E-mail</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">Password Confirm</label>
                                <div class="col-lg-10">
                                    <input type="password" name="password_confirm" class="form-control" placeholder="Password Confirm" required>
                                </div>
                            </div>
                            <div class="form-group row pb-4">
                                <label class="col-lg-2">Active</label>
                                    <div class="col-lg-10">
                                        <input type="checkbox" id="active" name="active" value="1"> Active
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


