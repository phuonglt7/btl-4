    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click", ".btn-delete", function() {
        var id = $(this).parents("tr").attr('data-id');
        let url = $(this).data('link-delete');
        var result = confirm('Bạn có muốn thực hiện xóa vĩnh viễn?');
        if (result) {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id:id
                },
                success: (response) => {
                    if(response.success){
                        $(this).parents("tr").remove();
                        $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                    }
                }
            });
        }
    });

    $(document).on("click", ".btn-restore", function() {
        var id = $(this).parents("tr").attr('data-id');
        let url = $(this).data('link');
        var result = confirm('Bạn có muốn thực hiện phục hồi?');
        if (result) {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    id:id
                },
                success: (response) => {
                    if(response.success){
                        $(this).parents("tr").remove();
                        $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                    }
                }
            });
        }
    });