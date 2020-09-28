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
                <h6>{{$link->regular_link}}</h6>
                <a href="{{$link->short_link}}">{{$link->short_link}}</a>
                <h6>Статистика:</h6>

                <p>Количество перехов: {{$link->number_of_transitions}}</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ip</th>
                        <th scope="col">User-Agent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @forelse($statistic->orderBy('id', 'desc')->get(['ip', 'user_agent']) as $stat)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$stat['ip']}}</td>
                            <td>{{$stat['user_agent']}}</td>
                        </tr>
                    @empty
                        <p>По ссылке пока никто не переходил</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <p>Hi, {{ auth()->user()->username }}</p>
                <p><a href="{{ route('logout') }}" class="btn btn-primary">Logout</a></p>
            </div>
        </div>
    </div>
@endsection
