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
                <form method="post" action="{{route('edit',$link->id)}}">
                    <div class="form-group">
                        @csrf

                        <label for="updateLink">Редактировать ссылку {{$link->regular_link}}</label>
                        @error('createLink')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <input type="text" class="form-control" id="updateLink" name="updateLink" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </form>
            </div>
            <div class="col-4">
            <p>Hi, {{ auth()->user()->username }}</p>
            <p><a href="{{ route('logout') }}" class="btn btn-primary">Logout</a></p>
            </div>
        </div>
    </div>
@endsection
