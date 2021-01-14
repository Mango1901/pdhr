@foreach($getAllEmployees as $getAllEmployee)
<!--modal them mới-->
<div class="modal fade" id="time{{$getAllEmployee->id}}" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold color_modal">Thời gian</h3>
                <button type="button" data-dismiss="modal" class="close">x</button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group row pt-3">
                            <label class="col-lg-2">Họ tên</label>
                            <div class="col-lg-6">{{$getAllEmployee->full_name}}</div>
{{--                            <label class="col-lg-1">Tháng</label>--}}
{{--                            <div class="col-lg-3">--}}
{{--                                <input type="text" class="">--}}
{{--                            </div>--}}
                        </div>
                        <table class="table table-bordered">
                            <thead class="bg_tb">
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Check in</th>
                                <th>Check out</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>{{$getAllEmployee->id}}</td>
                                <td>{{$getAllEmployee->full_name}}</td>
                                <td>{{$getAllEmployee->in_date}}</td>
                                @if($getAllEmployee->out_date)
                                <td>{{$getAllEmployee->out_date}}</td>
                                @else
                                    <td>NULL</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
