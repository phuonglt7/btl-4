@extends('trashed.layouts')

@section('content-trashed')
<thead>
    <th>STT</th>
    <th>Author</th>
    <th width="200px">Action</th>

</thead>

<tbody>
    @foreach($view as $key => $item)
    <tr data-id="{{ $item->id }}" data-name="{{ $item->author_name }}" >
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->author_name }} </td>
        <td>
            <div class = "d-flex">
                <form action="{{route('trash-author.restore') }}" class="submitDelete" method="post" onsubmit="return confirmRestore();" >
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="author_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-info btn-edit mr-4 ml-4">Phục hồi</button>
                </form>
                <form action="{{route('trash-author.delete') }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="author_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach

</tbody>
@endsection
