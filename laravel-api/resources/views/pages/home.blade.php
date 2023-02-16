@extends('layouts.main-layouts')

@section('head')
    <title>Home</title>
@endsection

@section('main')
<section class="container-fluid">
    <div class="container">
            <h1>Home</h1>
            <a href="{{ route('movie.create') }}" class="btn btn-primary mb-3">Create</a>
            <div class="row row-cols-4">
                @foreach ($movies as $movie)
                    <div class="col d-flex align-items-stretch mb-4">
                        <a href="{{ route('movie.show', $movie) }}" class="shadow card flex-grow-1 d-flex flex-column justify-content-between p-2">
                            
                            
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
                            
                            
                        </a>
                        <div class="d-flex flex-column justify-content-center gap-2">
                            <a href="{{ route('movie.delete', $movie) }}" class="btn btn-danger d-flex align-items-center justify-content-center">x</a>
                            <a href="{{ route('movie.edit', $movie) }}" class="btn btn-primary d-flex align-items-center justify-content-center">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection