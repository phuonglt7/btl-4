@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>
<h3> QUẢN LÝ TÁC GIẢ </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#myModal">
  Tạo mới tác giả
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    @include('authors.add')
</div>

<br/>

<table class="table table-bordered data-table">
    <thead>
        <th>STT</th>
        <th>Author</th>
        <th width="200px">Action</th>

    </thead>

    <tbody>
        @foreach($view as $item)
        <tr data-id="{{ $item->id }}" data-name="{{ $item->author_name }}" >
            <td> {{ $i ++}}</td>
            <td> {{ $item->author_name }} </td>
            <td>
                <div class = "d-flex">
                    <button class='btn btn-info btn-xs btn-edit'>Edit</button>
                    <form action="{{route('author.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs btn-cancel">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>

</table>
{{ $view->links() }}

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("body").on("click", ".btn-edit", function(){
        var name = $(this).parents("tr").attr('data-name');

        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_name" value="'+name+'">');
        $(this).parents("tr").find("td:eq(2)").prepend("<button class='btn btn-info btn-xs btn-update'>Lưu</button><button class='btn btn-warning btn-xs btn-cancel'>Hủy</button>")
        $(this).hide();

    });

    $("body").on("click", ".btn-cancel", function(){
        var name = $(this).parents("tr").attr('data-name');

        $(this).parents("tr").find("td:eq(1)").text(name);
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });


    $("body").on("click", ".btn-update", function(){

        var id = $(this).parents("tr").attr('data-id');
        var name = $(this).parents("tr").find("input[name='edit_name']").val();
        $.ajax({
         method:'POST',
         url:'author/update/'+id,
         data:{author_name:name},
         success: function(response){
            $(this).parents("tr").find("td:eq(1)").text(name);

            $(this).parents("tr").attr('data-name', name);
            $(this).parents("tr").find(".btn-edit").show();
            $(this).parents("tr").find(".btn-cancel").remove();
            $(this).parents("tr").find(".btn-update").remove();
        }
    });
    });
</script>
@endsection
