@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<div class="float-right alert" >
</div>
<h3> QUẢN LÝ TÀI KHOẢN</h3>

<br/>

<table class="table table-bordered data-table">
    <thead>
        <th>username</th>
        <th>full-name </th>
        <th>email</th>
        <th width="200px">Action</th>

    </thead>

    <tbody>
        <tr data-id="{{ Auth::id() }}">
            <td>{{ $view->username }}</td>
            <td>{{ $view->fullname }} </td>
            <td>{{ $view->email }}</td>
            <td>
                <div class = "d-flex">
                    <button class='btn btn-info btn-edit ml-4 mr-4'>Sửa</button>
                </div>
            </td>
        </tr>
    </tbody>

</table>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("click", ".btn-edit", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("td:eq(1)").text();
        td1 = '<input name="edit_name" value="'+name+'">';
        td2 = "<button class='btn btn-info m-4 btn-update'>Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>";
        tr.find("td:eq(1)").html(td1);
        tr.find("td:eq(3)").prepend(td2);
        $(".btn-danger").hide();
        $(".btn-edit").hide();

    });

    $(document).on("click", ".btn-cancel", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("td:eq(1)").attr('data-name');
        $(this).parents("tr").find("td:eq(1)").text(name);
        $(".btn-update").remove();
        $(".btn-warning").remove();
        $(".btn-danger").show();
        $(".btn-edit").show();
    });


    $(document).on("click", ".btn-update", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("input[name='edit_name']").val();
        var id = tr.attr('data-id');
        let url = "{{ route('post-information') }}";
        $.ajax({
            method:'POST',
            url:url,
            data:{fullname:name},
            success: (response) => {
                $(this).parents("tr").find("td:eq(1)").text(name);
                $(this).parents("tr").attr('data-name', name);
                $(".btn-update").remove();
                $(".btn-warning").remove();
                $(".btn-danger").show();
                $(".btn-edit").show();
                if(response.success){
                    $(".alert").addClass('alert-success');
                    $(".alert").html(response.success);
                } else {
                    $(".alert").addClass('alert-danger')
                    $(".alert").html(response.error);
                }
            },
            error: (data) => {
                $(".alert").addClass('alert-danger')
                $(".alert").html(data.responseJSON.errors.fullname);
            }
        });
    });
</script>



@endsection
