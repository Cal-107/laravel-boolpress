<template>
  <section class="container mt-5">
      <div v-if="post">
          <h1>{{ post.title }}</h1>

          <h4>Category: {{ post.category.name }}</h4>

         <Tags class="mb-5" :list="post.tags" />

          <p>{{ post.content }}</p>

          <router-link class="btn btn-primary" :to="{name: 'home'}">Back To Blog</router-link>
      </div>
      <Loader text="Loading post" v-else />
  </section>
</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader'
import Tags from '../components/Tags'


export default {
    name: 'PostDetail',
    components: {
        Loader,
        Tags,
    },
    data() {
        return {
            post: null,
        }
    },
    created() {
        this.getPostDetail();
    },
    methods: {
        getPostDetail() {
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then(result => {
                if (result.data.not_found) {
                    this.$router.push({ name: 'not-found' })
                } else {
                    this.post = result.data;
                }
            })
            .catch(error => log.error(error));
        }
    }
}
</script>

<style>

</style>