@extends('books.layouts')

@section('content-book')
<tbody>
    @foreach($view as $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $i ++}}</td>
        <td> {{ $item->book_name }} </td>
        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach

        @if ($item->book_status == 1)
        <td> Chưa mượn </td>
        @elseif($item->book_status == 2)
        <td> Đang xem </td>
        @elseif ($item->book_status == 3)
        <td> Đã mượn </td>
        @endif
        <td> </td>
        <td>
            <div class = "d-flex">
                <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                <form action="{{route('book.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}
@include('books.editShow')

@endsection
