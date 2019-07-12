@extends('layouts.app')

@section('execute')
<div class="float-right">
    @include('layouts.announce')
</div>

<h3> MƯỢN SÁCH </h3>
<div class = "ml-5">
    <table width="400px">
        <tr>
            <td>Tên sách:</td>
            <td> {{ $view->book_name }} </td>
        </tr>
        <tr>
            <td>Tác giả:</td>
            @foreach($authorList as $author)
            @if ($author->id == $view->author_id)
            <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
            @endif
            @endforeach
        </tr>
        <tr>
            <td></td>
            <td> </td>
            <td>
                <button class='btn btn-info btn-edit mr-4 ml-4'>Mượn</button>
                <button class='btn btn-info btn-edit mr-4 ml-4'>Hủy</button>
           </td>
       </tr>
   </table>
</div>
@endsection
