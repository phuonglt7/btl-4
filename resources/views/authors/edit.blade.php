<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("body").on("click", ".btn-edit", function(){
        var name = $(this).parents("tr").attr('data-name');

        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_name" value="'+name+'">');
        $(this).parents("tr").find("td:eq(2)").prepend("<button class='btn btn-info btn-update'>Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>");
        $(".btn-danger").hide();
        $(".btn-edit").hide();

    });

    $("body").on("click", ".btn-cancel", function(){
        var name = $(this).parents("tr").attr('data-name');

        $(this).parents("tr").find("td:eq(1)").text(name);
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-warning").remove();
        $(this).parents("tr").find(".btn-danger").show();
        $(".btn-danger").show();
        $(".btn-edit").show();
    });


    $("body").on("click", ".btn-update", function(){

        var id = $(this).parents("tr").attr('data-id');
        var name = $(this).parents("tr").find("input[name='edit_name']").val();
        $.ajax({
           method:'POST',
           url:'author/update/'+id,
           data:{author_name:name},
           success: (response) => {
            $(this).parents("tr").find("td:eq(1)").text(name);
            $(this).parents("tr").attr('data-name', name);
            $(this).parents("tr").find(".btn-update").remove();
            $(this).parents("tr").find(".btn-warning").remove();
            $(this).parents("tr").find(".btn-danger").show();
            $(".btn-danger").show();
            $(".btn-edit").show();
            console.log(response);
        }
    });
    });
</script>