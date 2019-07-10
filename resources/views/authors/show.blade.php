@include('layouts.announce')
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <label for="author_name" class="mr-sm-2">Tác giả:</label>
                <input type="text" class="form-control mb-2 mr-sm-2" name="author_name" id="author_name">
            </div>





$("body").on("click", ".btn-delete", function(){

        $(this).parents("tr").remove();

    });


    $("body").on("click", ".btn-edit", function(){

        var name = $(this).parents("tr").attr('data-name');

        $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');


        $(this).parents("tr").find("td:eq(1)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")

        $(this).hide();

    });



    $("body").on("click", ".btn-cancel", function(){

        var name = $(this).parents("tr").attr('data-name');





@extends('layouts.app')

@section('execute')
<h3> QUẢN LÝ TÁC GIẢ </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Tạo mới tác giả
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    @include('authors.add')
</div>
@include('layouts.announce')
<table class="table table-striped" id='userTable'>
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Hành động</th>
    </tr>
</thead>
<tbody>
    @foreach($dataAuthors as $item)
    <tr>
        <td> {{$i++}} </td>
        <td> <input type='text' value='{{ $item->author_name }}' id="author_name_{{$item->id}}"> </td>
        <td>
            <input type='button' value='Update' class='update' data-id='{{$item->id}}' ><input type='button' value='Delete' class='delete' data-id='{{$item->id}}' >
            <button class="btn-delete" > Xoa </button>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").click(function(e){

        e.preventDefault();

        $.ajax({

           method:'POST',

           url:'{{ route("author.store")}}',

           data:{author_name:$("input[name=author_name]").val()},
    success: function(response){ // What to do if we succeed
        /*console.log(response);*/
        if(response > 0){
            var id = response;
            var findnorecord = $('#userTable tr.norecord').length;

            if(findnorecord > 0){
              $('#userTable tr.norecord').remove();
            }
            var tr_str = "<tr>"+
            "<td align='center'><input type='text' value='" + author_name + "' id='author_name_"+id+"'></td>" +
            "<td align='center'><input type='button' value='Update' class='update' data-id='"+id+"' ><input type='button' value='Delete' class='delete' data-id='"+id+"' ></td>"+
            "</tr>";

            $("#userTable tbody").append(tr_str);
          }else if(response == 0){
            alert('Username already in use.');
          }else{
            alert(response);
          }

          // Empty the input fields
          $('#author_name').val('');
      });
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        console.log(JSON.stringify(jqXHR));
        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    }
        });

    });

$(document).on("click", ".update" , function() {
  var edit_id = $(this).data('id');

  var author_name = $('#author_name_'+edit_id).val();

  if(name != '' && email != ''){
    $.ajax({
      url: 'updateUser',
      type: 'post',
      data: {_token: CSRF_TOKEN,editid: edit_id,author_name: author_name},
      success: function(response){
        alert(response);
      }
    });
  }else{
    alert('Fill all fields');
  }
});

var txt;
var r = confirm("Bạn có muốn thực hiện xóa ");
if (r == true) {
  txt = "You pressed OK!";
} else {
  txt = "You pressed Cancel!";
}
</script>
@endsection
