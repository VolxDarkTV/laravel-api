<script>
import axios from 'axios';

const apiURL = 'http://localhost:8000/api/v1/';
export default{

  data(){
    
    return {
      movies:[],
    }

  },

  methods:{

    deleteMovie(id){

      axios.get(apiURL + 'movie/delete/' + id)
      .then(res => {

        const data = res.data;
        const success = data.success;


        if(success){
          this.updateMovies();
        }
        console.log(this.movies);
      })
      .catch(err => console.error(err));

    },

    updateMovies(){
      axios.get(apiURL + 'movie')
      .then(res => {

        const data = res.data;
        const success = data.success;
        const movies = data.response;

        if(success){
          this.movies = movies;
        }
        console.log(movies);
      })
      .catch(err => console.error(err));
    }

  },

  mounted(){
    this.updateMovies();
  },
}
</script>

<template>
    <h1>Movies</h1>

    <form>

      <div class="card p-3">
        <h6 class="text-dark">Form</h6>
        <div class="d-flex flex-column gap-2">
            <input type="text" name="name" id="name" placeholder="name">
            <input type="number" name="year" id="year" placeholder="year">
            <input type="number" name="cashOut" id="cashOut" placeholder="cashOut">
            
            <!-- Genre -->
            <!-- <select name="genre_id" id="genre_id">

              <option value="{{$genre -> id}}">{{$genre -> name}}</option>

            </select> -->

            <div>

              <!-- Tags -->
              <!-- <input type="checkbox" name="tags_id[]" id="{{$tag -> id}}" value="{{$tag -> id}}">
              <label for="{{$tag -> id}}">{{$tag -> name}}</label>
              <br> -->

            </div>
            <div class="d-flex gap-3">
              <input type="submit" value="Cancel">
              <input class="flex-grow-1" type="submit" value="Create">
            </div>
        </div>
      </div>    

    </form>

    <ul>
      <li v-for="movie in movies" :key="movie.id">
        {{ movie.name }}

        <button @click="deleteMovie(movie.id)">delete</button>
      </li>
    </ul>
</template>

<style lang="scss">
@use './styles/general.scss' as *;

</style>
