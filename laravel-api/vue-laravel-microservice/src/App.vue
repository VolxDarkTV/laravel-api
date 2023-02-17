<script>
import axios from 'axios';

export default{
  data(){
    return {
      movies:[],
    }
  },
  mounted(){
    axios.get('http://localhost:8000/api/v1/test')
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
  },
}
</script>

<template>
    <h1>Movies</h1>
    <ul>
      <li v-for="movie in movies" :key="movie.id">
        {{ movie.name }}
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
