
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-save-add', function () {
        var name = $("input[name='author_name']").val();
        var tr = $(this).parents("tr");
        let url = $(this).attr('data-link-add');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                author_name:name
            },
            success: (response) => {
                $('.close').trigger('click');
                var td3 = '<div class = "d-flex"><button class="btn btn-info btn-edit mr-4 ml-4">Sửa</button> <button class="btn btn-danger btn-delete">Xóa</button></div>';
                $("tbody").append("<tr class='add'><td> New </td> <td>"+name+"</td><td>"+td3+"</td></tr>");
                if(response.success){
                    $(".alert").addClass('alert-success');
                    $(".alert").html(response.success);
                } else {
                    $(".alert").addClass('alert-danger')
                    $(".alert").html(response.error);
                }
                //setTimeout(function(){ $(".alert").html('');},3000);
            },
            error: (data) => {
                $(".alert").addClass('alert-danger')
                $(".alert").html(data.responseJSON.errors.author_name);
                setTimeout(function(){ $(".alert").hide();},3000);
            }
        });
    });

    $(document).on("click", ".btn-edit", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("td:eq(1)").attr('data-name');
        td1 = '<input name="edit_name" value="'+name+'">';
        td2 = "<button class='btn btn-info m-4 btn-update' data-link-edit='{{ route('author.destroy.ajax') }}' >Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>";
        tr.find("td:eq(1)").html(td1);
        tr.find("td:eq(2)").prepend(td2);
        $(".btn-danger").hide();
        $(".btn-edit").hide();

    });

    $(document).on("click", ".btn-cancel", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("td:eq(1)").attr('data-name');
        $(this).parents("tr").find("td:eq(1)").text(url);
        $(".btn-update").remove();
        $(".btn-warning").remove();
        $(".btn-danger").show();
        $(".btn-edit").show();
    });


    $(document).on("click", ".btn-update", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("input[name='edit_name']").val();
        var id = tr.attr('data-id');
        let url = tr.find("td:eq(2)").attr('data-link-edit');
        $.ajax({
            method:'POST',
            url:url,
            data:{id:id, author_name:name},
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
                //setTimeout(function(){ $(".alert").hide();},3000);
            },
            error: (data) => {
                $(".alert").addClass('alert-danger')
                //$(".alert").html(data.responseJSON.errors.author_name);
//setTimeout(function(){ $(".alert").hide();},3000);
            }
        });
    });

    $(document).on("click", ".btn-delete", function() {
        var id = $(this).parents("tr").attr('data-id');
        let url = $(this).attr('data-link-delete');
        $.ajax({
            type: 'post',
            url: url,
            data: {
                id:id
            },
            success: (response) => {
                if(response.success){
                    $(this).parents("tr").remove();
                    $(".alert").addClass('alert-success');
                    $(".alert").html(response.success);
                } else {
                    $(".alert").addClass('alert-danger')
                    $(".alert").html(response.error);
                }
                //setTimeout(function(){ $(".alert").hide();},3000);
            },
            error: (data) => {
                $(".alert").addClass('alert-danger')
                $(".alert").html(data.responseJSON.errors.id);
                setTimeout(function(){ $(".alert").hide();},3000);
            }
        });
    });

