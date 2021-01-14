@extends("layout")
@section("title","User")
@section("view")
    <h4 class="text-center font-weight-bold mb-0 set_lineheigh">Sửa người dùng</h4>
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
                <form action="{{route("user.update",["id"=>$getEditUser->id])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid bg_modal set_heigh">
                            <div class="form-group row pt-3">
                                <label class="col-lg-2">Tên người dùng</label>
                                <div class="col-lg-10">
                                    <input type="text" name="username" value="{{$getEditUser->username}}" class="form-control" placeholder="Tên người dùng" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2">E-mail</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" value="{{$getEditUser->email}}" class="form-control" placeholder="E-mail" required>
                                </div>
                            </div>
                            @can("is-admin")
                            <div class="form-group row pb-3">
                                <label class="col-lg-2">Hoạt động</label>
                                <div class="col-lg-10">
                                    @if($getEditUser->active === 1)
                                    <label><input type="checkbox" id="active" checked name="active" value="1">Active</label>
                                    @else
                                        <label><input type="checkbox" id="active" name="active" value="1">Active</label>
                                    @endif
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <input type="submit" class="btn btn-primary" value="Sửa">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                    </div>
                </form>
@endsection
