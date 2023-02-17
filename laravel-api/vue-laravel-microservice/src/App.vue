<script>
import axios from 'axios';

const apiURL = 'http://localhost:8000/api';
export default{

  data(){
    
    return {
      movies:[],
      genres:[],
      tags:[],

      movie_name: '',
      movie_year: '',
      movie_cashOut: '',

      movie_genre: '',
      movie_tags: [],

    }

  },

  methods:{

    deleteMovie(id){

      axios.get(apiURL + '/v1/movie/delete/' + id)
      .then(res => {

        const data = res.data;
        const success = data.success;


        if(success){
          this.updateMovies();
        }
        // console.log(this.movies);
      })
      .catch(err => console.error(err));

    },

    createMovie(e){

      e.preventDefault();

      const movie = {
        'name' : this.movie_name,
        'year' : this.movie_year,
        'cashOut' : this.movie_cashOut,
        'genre_id' : this.movie_genre,
        'tags_id' : this.movie_tags,

      };

      // Info Logs
      console.log('movie', movie);
      // console.log('movie_tag', this.movie_tags);

      // Laravel Store Connection 
      axios.post(apiURL + '/v1/movie/store/', movie)
        .then(res => {
          const data = res.data;
          const success = data.success;
          // console.log('data', data);
          if(success){
            this.updateMovies();
          }
        }).catch(err => console.error(err));
    },




    // API method
    updateMovies(){
      axios.get(apiURL + '/v1/movie')
      .then(res => {

        const data = res.data;
        const success = data.success;
        const response = data.response;
        const movies = response.movies;
        const genres = response.genres;
        const tags = response.tags;

        if(success){
          this.movies = movies;
          this.genres = genres;
          this.tags = tags;
        }
        // console.log(movies);
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
            <input type="text" name="name" id="name" placeholder="name" v-model="movie_name">
            <input type="number" name="year" id="year" placeholder="year" v-model="movie_year">
            <input type="number" name="cashOut" id="cashOut" placeholder="cashOut" v-model="movie_cashOut">
            
            <!-- Genre -->
            <select name="genre_id" id="genre_id" v-model="movie_genre">

              <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{genre.name}}</option>

            </select>

            <div class="text-dark" v-for="tag in tags" :key="tag.id">

              <!-- Tags -->
              <input  type="checkbox" name="tags_id[]" :id="tag.id" :value="tag.id" v-model="movie_tags">
              <label :for="tag.id">{{tag.name}}</label>
              <br>

            </div>

            <div class="d-flex gap-3">
              <input type="submit" value="Cancel">
              <input class="flex-grow-1" type="submit" value="Create" @click="createMovie">
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
