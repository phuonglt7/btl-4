
<script type="text/javascript">
    $(document).ready(function() {

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
                $("#book").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                alert('No response from server');
            });
        }

        $(document).on('click', '.list-book', function(){
            var url = $(this).data('url');
            var href = $(this).data('href');
            $.ajax(
                {
                    url: url,
                    type: "get",
                    datatype: "html",
                    success: (data) =>{
                        window.history.pushState('string', '', href);
                        $('li').removeClass('active');
                        $(this).parents('li').addClass('active');
                        $("#book").html(data);
                    }

                })
        });



        $('.btn-save-add').on('click', function () {
            var book_name = $("input[name='book_name']").val();
            var author_id = $("#author_id_add").val();

            var td2 = '@foreach($authorList as $author) @if ($author->id == '+author_id+')<td data-author="{{ $item->author_id }}"> {{ $author->author_name }} </td>@endif @endforeach';
            $.ajax({
                type: 'POST',
                url: '{{ route("book.store")}}',
                data:{book_name:book_name, author_id:author_id},
                success: function(response) {
                    $('.close').trigger('click');
                    $("tbody").add("<tr class='add'></tr>");
                    if(response.success){
                        $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                    }
                    setTimeout(function(){ $(".alert-ajax").remove();},5000);
                },
                error: (data) => {
                    $("input[name='book_name']").after("<small class='text-danger'>"+data.responseJSON.errors.book_name+"</small>");
                    $("#author_id_add").after("<small class='text-danger'>"+data.responseJSON.errors.author_id+"</small>");
                    setTimeout(function(){ $("small").remove();},5000);
                }
            });

        });

        $(".btn-edit").on("click", function(){
            /*var tr =  $(this).parents("tr");
            var book_name = tr.find("td:eq(1)").text();
            var author_id = tr.find("td:eq(2)").data('author');*/

            //var url = $(this).data('url');
            var tr = $(this).parents("tr");
            var id = $(this).parents("tr").attr('data-id');
            var book_name = tr.find("td:eq(1)").text();
            var author_id = tr.find("td:eq(2)").data('author');

            var data = {id : id , rowid: author_id};
                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'html',
                    success: function(result) {
                        tr.empty();
                        tr.html(result);
                    },
                });
            }


            tr.find("td:eq(1)").html(`<input name="edit_name" value="${book_name}">`);
            tr.find("td:eq(2)").html(`<select name='author_id' id='author_id'>@foreach($authorList as $author)<option value="{{ $author->id }}" @if(author_id == $author->id) selected @endif >{{ $author->author_name }}</option> @endforeach</select>`);
            tr.find("td:eq(5)").prepend("<button class='btn btn-info btn-update'>Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>");
            $(".btn-danger").hide();
            $(".btn-edit").hide();

            $(".btn-warning").on("click", function(){
                var tr =  $(this).parents("tr");
                var book_name = tr.find("input[name='edit_name']").val();
                var author_name = tr.find("#author_id :selected").text();
                var author_id = tr.find("#author_id").val();

                tr.find("td:eq(1)").text(book_name);
                tr.find("td:eq(2)").text(author_name);
                $(".btn-danger").show();
                $(".btn-edit").show();
                $(".btn-update").remove();
                $(".btn-warning").remove();
            });

            $(".btn-update").on("click", function(){
                var tr =  $(this).parents("tr");
                var id = tr.attr('data-id');
                var book_name = tr.find("input[name='edit_name']").val();
                var author_name = tr.find("#author_id :selected").text();
                var author_id = tr.find("#author_id").val();
                $.ajax({
                    method:'POST',
                    url: "{{ route('book.update.ajax') }}",
                    data:{id:id, book_name:book_name, author_id:author_id},
                    success: (response) => {
                        $(this).parents("tr").find("td:eq(1)").text(book_name);
                        $(this).parents("tr").find("td:eq(2)").text(author_name);
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
                        $(".alert").addClass('alert-danger')
                        $(".alert").html(data.responseJSON.errors.book_name+" <br/>"+ data.responseJSON.errors.author_id);
                        setTimeout(function(){ $(".alert").hide();},5000);
                    }
                });
            });
        });
        $(".btn-delete").on("click", function() {
            var result = confirm('Bạn có muốn thực hiện xóa');
            if (result) {
                var id = $(this).parents("tr").attr('data-id');
                $.ajax({
                    type: 'post',
                    url: "{{ route('book.destroy.ajax') }}",
                    data: {
                        id:id
                    },
                    success:(response) => {
                        if(response.success){
                            $(this).parents("tr").remove();
                            $(".alert").html("<div class='alert alert-success alert-ajax'>"+response.success+"</div>");
                        } else {
                            $(".alert").html("<div class='alert alert-danger alert-ajax'>"+response.error+"</div>");
                        }
                        setTimeout(function(){ $(".alert-ajax").remove();},5000);
                    }
                });
            }
        });

    });
</script>