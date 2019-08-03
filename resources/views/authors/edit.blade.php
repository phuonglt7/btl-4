<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];

            getData(page);
        });

    });

    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#author").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
          alert('No response from server');
      });
    }


/*
    $(document).on('click','.page-item', function (){
        let page = $(this).text();
        alert(page);
        let url = "{{ route('author.page') }}/"+page;
        $.ajax({
            type: 'GET',
            url: url,
            success: (data) => {
                console.lod(data);
                //$('#table-author').html(data);
            }
        });
        return false
    });*/

    $(document).on('click', '.btn-save-add', function () {
        var name = $("input[name='author_name']").val();
        var tr = $(this).parents("tr");
        $.ajax({
            type: 'POST',
            url: '{{ route("author.store")}}',
            data: {
                author_name:name
            },
            success: (response) => {
                $('.close').trigger('click');
                var td3 = '<div class = "d-flex"><button class="btn btn-info btn-edit mr-4 ml-4">Sửa</button> <button class="btn btn-danger btn-delete">Xóa</button></div>';
                $("tbody").append("<tr class='add'><td> New </td> <td>"+name+"</td><td>"+td3+"</td></tr>");
                if(response.success){
                    $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                } else {
                    $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                }
                setTimeout(function(){ $(".alert-ajax").remove();},5000);
            },
            error: (data) => {
                $("input[name='author_name']").after("<small class='text-danger'>"+data.responseJSON.errors.author_name+"</small>");
                setTimeout(function(){ $("small").remove();},5000);
            }
        });
    });

    $(document).on("click", ".btn-edit", function(){
        var tr = $(this).parents("tr");
        var name = tr.find("td:eq(1)").attr('data-name');
        td1 = '<input name="edit_name" value="'+name+'">';
        td2 = "<button class='btn btn-info m-4 btn-update'>Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>";
        tr.find("td:eq(1)").html(td1);
        tr.find("td:eq(2)").prepend(td2);
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
        let url = "{{ route('author.update.ajax') }}";
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
                    $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                } else {
                    $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                }
                setTimeout(function(){ $(".alert-ajax").remove();},5000);
            },
            error: (data) => {
                $(".alert").html(data.responseJSON.errors.book_name+" <br/>"+ data.responseJSON.errors.author_name);
                setTimeout(function(){ $(".alert-ajax").remove();},5000);
            }
        });
    });

    $(document).on("click", ".btn-delete", function() {
        var id = $(this).parents("tr").attr('data-id');
        // Confirm box
        var result = confirm('Bạn có muốn thực hiện xóa');
        if (result) {
            $.ajax({
                type: 'post',
                url: "{{ route('author.destroy.ajax') }}",
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
</script>


