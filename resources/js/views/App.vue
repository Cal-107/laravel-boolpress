<template>
  <div>
      <h1>Work in progress</h1>
      <h2>Website under construction</h2>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'App',
    components: {},
    data() {
        return {
            posts: null,
        }
    },
    created() {
        this.getPosts()
    },
    methods: {
        getPosts() {
            console.log('Axios call here')
        }
    }
}
</script>

<style lang="scss">
    div {
        h1 {
            text-transform: uppercase;
        }
    }
</style>