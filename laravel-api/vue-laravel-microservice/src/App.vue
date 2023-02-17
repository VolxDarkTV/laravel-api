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
        console.log(movies);
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
    <ul>
      <li v-for="movie in movies" :key="movie.id">
        {{ movie.name }}

        <button @click="deleteMovie(movie.id)">delete</button>
      </li>
    </ul>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
