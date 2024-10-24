@extends('layout.master')

@section('content')
<div class="container">
    <h1>Panduan Peternak Ikan</h1>
    @can('create', App\Models\GuideBook::class)
        <a href="{{ route('guide-books.create') }}" class="btn btn-primary mb-3">Buat Guide Book Baru</a>
    @endcan
    <ul>
        @foreach($guideBooks as $guideBook)
            <li>
                <a href="{{ route('guide-books.show', $guideBook) }}">{{ $guideBook->title }}</a>
                @can('update', $guideBook)
                    <a href="{{ route('guide-books.edit', $guideBook) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan
                @can('delete', $guideBook)
                    <form action="{{ route('guide-books.destroy', $guideBook) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
</div>
@endsection
