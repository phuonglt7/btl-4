<table class="table table-bordered data-table" id="table-author">
    <thead>
        <th>STT</th>
        <th>Author</th>
        <th width="200px">Action</th>
    </thead>

    <tbody>
        @foreach($view as $key => $item)
        <tr data-id="{{ $item->id }}">
            <td> {{ $key + 1 + PAGE * ($page - 1)}}</td>
            <td  data-name="{{ $item->author_name }}" > {{ $item->author_name }} </td>
            <td>
                <div class = "d-flex">
                   <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button> 
                   <button class="btn btn-danger btn-delete" >Xóa</button>
               </div>
           </td>
       </tr>
       @endforeach
   </tbody>
</table>
{{ $view->links() }}
