
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("body").on("click", ".btn-edit", function(){

        var book_name = $(this).parents("tr").find("td:eq(1)").text();
        var author_id = $(this).parents("tr").find("td:eq(2)").attr('data-author');

        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_name" value="'+book_name+'">');
        $(this).parents("tr").find("td:eq(2)").html("<select name='author_id' id='author_id'>@foreach($authorList as $author)@if($author->id == "+author_id+")<option value='{{ $author->id }}' selected>{{ $author->author_name }}</option> @else <option value='{{ $author->id }}'>{{ $author->author_name }}</option> @endif @endforeach</select>");
        $(this).parents("tr").find("td:eq(5)").prepend("<button class='btn btn-info btn-update' data-link='book/update/' >Lưu</button><button class='btn btn-warning btn-cancel'>Hủy</button>");
        $(".btn-danger").hide();
        $(".btn-edit").hide();

    });

    $("body").on("click", ".btn-warning", function(){
        var book_name = $(this).parents("tr").find("input[name='edit_name']").val();
        var author_name = $(this).parents("tr").find("#author_id :selected").text();
        var author_id = $(this).parents("tr").find("#author_id").val();

        $(this).parents("tr").find("td:eq(1)").text(book_name);
        $(this).parents("tr").find("td:eq(2)").text(author_name);
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-warning").remove();
        $(this).parents("tr").find(".btn-danger").show();
        $(".btn-danger").show();
        $(".btn-edit").show();
    });

    $("body").on("click", ".btn-update", function(){
        var id = $(this).parents("tr").attr('data-id');
        var book_name = $(this).parents("tr").find("input[name='edit_name']").val();
        var author_name = $(this).parents("tr").find("#author_id :selected").text();
        var author_id = $(this).parents("tr").find("#author_id").val();
      $.ajax({
         method:'POST',
         url: 'book/update/'+id,
         data:{book_name:book_name, author_id:author_id},
         success: (response) => {
            $(this).parents("tr").find("td:eq(1)").text(book_name);
            $(this).parents("tr").find("td:eq(2)").text(author_name);
            $(".btn-update").remove();
            $(".btn-warning").remove();
            $(".btn-danger").show();
            $(".btn-edit").show();
            $(".alert").html("Sửa thanh cong");
        }
    });
    });
</script>