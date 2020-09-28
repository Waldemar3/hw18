@extends('layout')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-8">
                <form method="post" action="{{route('create')}}">
                    <div class="form-group">
                        @csrf

                        <label for="createLink">Вставьте ссылку для сокращения</label>
                        @error('createLink')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <input type="text" class="form-control" id="createLink" name="createLink" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
                <br>
                @php($i=1)
                @forelse(auth()->user()->link()->orderBy('id', 'desc')->get() as $link)
                    <h6>{{$i++}} {{$link->regular_link}}</h6>
                    <a href="{{route('show', $link->id)}}">{{$link->short_link}}</a>
                    <form method="post" action="{{route('delete',$link->id)}}">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-primary" href="{{"links/{$link->id}/edit"}}" role="button">Редактировать</a>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    <br>
                @empty
                    <p>Ссылок нет</p>
                @endforelse
            </div>
            <div class="col-4">
                <p>Hi, {{ auth()->user()->username }}</p>
                <p><a href="{{ route('logout') }}" class="btn btn-primary">Logout</a></p>
            </div>
        </div>
    </div>
@endsection
