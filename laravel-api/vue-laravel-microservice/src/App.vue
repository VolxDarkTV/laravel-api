<script>
import axios from 'axios';

const apiURL = 'http://localhost:8000/api/';
const apiVersion = 'v1/';
const movieAPI = apiURL + apiVersion;

const EMPTY_NEW_MOVIE = {
  tags_id: []
};

export default{

  data(){
    
    return {
      movies:[],
      genres:[],
      tags:[],

      new_movie: { ...EMPTY_NEW_MOVIE },

      state: {
        movieForm: false
      }

    }

  },

  methods:{

    createMovie(e){

      e.preventDefault();

      const new_movie = this.new_movie;
      const actualApi = movieAPI + (
        'id' in new_movie 
        ? 'movie/update/' + this.new_movie.id
        : 'movie/store'
      );
      console.log(new_movie);
      console.log(actualApi);


      axios.post(actualApi, new_movie)
           .then(res => {

              const data = res.data;
              const success = data.success;

              if (success) {

                this.closeForm();
                this.updateData();
              }
           })
           .catch(err => console.log);
    },

    closeForm() {

      this.new_movie = { ...EMPTY_NEW_MOVIE };
      this.state.movieForm = false;
    },
    
    editMovie(movie){
      console.log('movie', movie);
      console.log('new_movie', this.new_movie);

      this.new_movie = { ...movie };

      this.new_movie.tags_id = [];

      for (let i = 0; i < movie.tags.length; i++) {

        const tag = movie.tags[i];
        this.new_movie.tags_id.push(tag.id);
      }
      this.state.movieForm = true;
    },

    deleteMovie(id){

      axios.get(movieAPI + 'movie/delete/' + id)
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


    // API method
    updateMovies(){
      axios.get(movieAPI + 'movie')
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

    <form v-if="state.movieForm">

      <div class="card p-3">
        <h6 class="text-dark">Form</h6>
        <div class="d-flex flex-column gap-2">
            <input type="text" name="name" id="name" placeholder="name" v-model="new_movie.name">
            <input type="number" name="year" id="year" placeholder="year" v-model="new_movie.year">
            <input type="number" name="cashOut" id="cashOut" placeholder="cashOut" v-model="new_movie.cashOut">
            
            <!-- Genre -->
            <select name="genre_id" id="genre_id" v-model="new_movie.genre_id">

              <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{genre.name}}</option>

            </select>

            <div class="text-dark" v-for="tag in tags" :key="tag.id">

              <!-- Tags -->
              <input  type="checkbox" name="tags_id[]" :id="tag.id" :value="tag.id" v-model="new_movie.tags_id">
              <label :for="tag.id">{{tag.name}}</label>
              <br>

            </div>

            <div class="d-flex gap-3">
              <input @click="closeForm" type="submit" value="Cancel">
              <input class="flex-grow-1" type="submit" :value="'id' in new_movie ? 'UPDATE MOVIE' : 'CREATE NEW MOVIE'" @click="createMovie">
            </div>
        </div>
      </div>    

    </form>
    <div v-else>
      <button @click="state.movieForm = true">
        CREATE MOVIE
      </button>
    </div>
    <ul>
      <li v-for="movie in movies" :key="movie.id">
        {{ movie.name }}

        <button @click="deleteMovie(movie.id)">delete</button>
        <button @click="editMovie(movie)">Edit</button>
      </li>
    </ul>
</template>

<style lang="scss">
@use './styles/general.scss' as *;

</style>
