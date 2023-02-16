@extends('layouts.main-layouts')

@section('head')
    <title>Movie Create</title>
@endsection

@section('main')

<section class="container-fluid">
    <div class="container">
            <h1>Edit</h1>
            @include('components.errors')
            <form method="post" action="{{ route('movie.update', $movie) }}">
                @csrf
                <div class="row row-cols-2">

                    <div class="w-25 col d-flex flex-column align-items-end justify-content-start gap-3">
                        <label for="name">name</label>
                        <label for="year">year</label>
                        <label for="cashOut">cashOut</label>
                    </div>
                    <div class="w-25 col d-flex flex-column gap-2">
                        <input type="text" name="name" id="name" value="{{ $movie -> name }}">
                        <input type="number" name="year" id="year" value="{{ $movie -> year }}">
                        <input type="number" name="cashOut" id="cashOut" value="{{ $movie -> cashOut }}">
                        
                        {{-- Genre --}}
                        <select name="genre_id" id="genre_id">
                            @foreach ($genres as $genre)
                                <option 
                                    value="{{$genre -> id}}"
                                    @if ($movie -> genre -> id == $genre -> id)
                                        selected
                                    @endif
                                >{{$genre -> name}}</option>
                            @endforeach
                        </select>

                        <div>
                            {{-- Tag --}}
                            @foreach ($tags as $tag)
                                <input 
                                    type="checkbox" 
                                    name="tags_id[]" 
                                    id="{{$tag -> id}}" 
                                    value="{{$tag -> id}}"
                                    @foreach ($movie -> tags as $movieTag)

                                        @if ($movieTag -> id == $tag -> id)
                                            checked
                                        @endif

                                    @endforeach
                                >
                                <label for="{{$tag -> id}}">{{$tag -> name}}</label>
                                <br>
                            @endforeach
                        </div>
                        <input type="submit" value="Update">
                    </div>
                </div>    

            </form>

        </div>
    </section>
@endsection