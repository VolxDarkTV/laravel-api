@extends('layouts.main-layouts')

@section('head')
    <title>Movie Create</title>
@endsection

@section('main')

<section class="container-fluid">
    <div class="container">
            <h1>Create</h1>
            @include('components.errors')
            <form method="post" action="{{ route('movie.store') }}">
                @csrf
                <div class="row row-cols-2">

                    <div class="w-25 col d-flex flex-column align-items-end justify-content-start gap-3">
                        <label for="name">name</label>
                        <label for="year">year</label>
                        <label for="cashOut">cashOut</label>
                    </div>
                    <div class="w-25 col d-flex flex-column gap-2">
                        <input type="text" name="name" id="name">
                        <input type="number" name="year" id="year">
                        <input type="number" name="cashOut" id="cashOut">
                        
                        {{-- Genre --}}
                        <select name="genre_id" id="genre_id">
                            @foreach ($genres as $genre)
                                <option value="{{$genre -> id}}">{{$genre -> name}}</option>
                            @endforeach
                        </select>

                        <div>
                            {{-- Tag --}}
                            @foreach ($tags as $tag)
                                <input type="checkbox" name="tags_id[]" id="{{$tag -> id}}" value="{{$tag -> id}}">
                                <label for="{{$tag -> id}}">{{$tag -> name}}</label>
                                <br>
                            @endforeach
                        </div>
                        <input type="submit" value="Create">
                    </div>
                </div>    

            </form>

        </div>
    </section>
@endsection