@extends('books.layouts')

@section('content-book')
<tbody>
    @foreach($view as $key=>$item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->book_name }} </td>
        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $item->author_id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach

        @if ($item->book_status == 1)
        <td> Chưa mượn </td>
        @elseif($item->book_status == 2)
        <td> Đang xem </td>
        @elseif ($item->book_status == 3)
        <td> Đã mượn </td>
        @endif
        <td>  @foreach($item->users as $p)
           {{ $p->username}}
           @endforeach
       </td>

       <td>
        <div class = "d-flex">
            <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
        </div>
    </td>
</tr>
@endforeach
</tbody>
@endsection
