@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                Wyniki wyszukiwania
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($search_results as $user)
                            <div class="col-md-4 center-block text-center">
                                <a href="{{ url('/users/' . $user->id) }}">
                                    <div class="thumbnail">
                                        <img src="{{ asset('user-avatar/' . $user->id . '/200') }}" class="img-responsive">
                                        <h4>{{ $user->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="row text-center">
                        <div class="col-md-12">
                            {{ $search_results->appends(['q' => $search_query])->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
