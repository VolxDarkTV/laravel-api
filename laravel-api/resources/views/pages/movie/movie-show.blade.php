@extends('layouts.main-layouts')

@section('head')
    <title>Movie Show</title>
@endsection

@section('main')
<section class="container-fluid">
    <div class="container">
            <h1>Show</h1>

            <div class="shadow card flex-grow-1 d-flex flex-column justify-content-between p-2">


                {{-- Film Card Info --}}
                <div>
                    <h3>{{ $movie -> name }}</h3>
                </div>
                <div class="d-flex justify-content-between align-items-center p-2">
                    <span class="bg-dark text-light rounded-pill px-2 py-1">
                        Cash Out: {{ $movie -> cashOut }}$
                    </span>
                    <span class="bg-success rounded-pill px-2 py-1">
                        {{ $movie -> year }}
                    </span>
                </div>
                <div>
                    <p>
                        @foreach ($movie -> tags as $tag)
                            <span class="shadow btn btn-warning rounded px-2 py-1 m-2">
                                {{$tag -> name}}
                            </span>
                        @endforeach
                    </p>
                </div>


            </div>

        </div>
    </section>
@endsection