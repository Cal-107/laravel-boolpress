<template>
    <div class="container mt-5">
        <h1 class="mb-4">Welcome to our Blog, fool!</h1>
        <div v-if="posts">
            <article
                class="mb-5"
                v-for="post in posts"
                :key="`post-${post.id}`"
            >
                <h3>{{ post.title }}</h3>
                <div class="mb-1">{{ formatDate(post.created_at) }}</div>

                <p>{{ getExcerpt(post.content, 150) }}</p>

                <router-link :to="{ name: 'post-detail', params: { slug: post.slug } }">
                    Read More
                </router-link>
            </article>

            <!-- Pagination -->
            <button
                class="btn btn-primary mr-2"
                @click="getPosts(pagination.current - 1)"
                :disabled="pagination.current === 1"
            >
                Prev
            </button>

            <button
                v-for="i in pagination.last"
                :key="`page-${i}`"
                class="btn mr-2"
                @click="getPosts(i)"
                :class="pagination.current === i ? 'btn-primary' : 'btn-danger'"
            >
                {{ i }}
            </button>

            <button
                class="btn btn-primary"
                @click="getPosts(pagination.current + 1)"
                :disabled="pagination.current === pagination.last"
            >
                Next
            </button>
        </div>
        <Loader text="Loading post archive" v-else />
    </div>
</template>

<script>
import axios from "axios";
import Loader from '../components/Loader';

export default {
    name: "Blog",
    components: {
        Loader,
    },
    data() {
        return {
            posts: null,
            pagination: null,
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then((result) => {
                    // console.log(result);

                    // A -> Without Paginations
                    // this.posts = result.data;

                    // B -> With Paginations
                    this.posts = result.data.data;
                    this.pagination = {
                        current: result.data.current_page,
                        last: result.data.last_page,
                    };
                });
        },

        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substr(0, maxLength) + "...";
            }
            return text;
        },

        formatDate(postDate) {
            // console.log(postDate);
            const date = new Date(postDate);
            // console.log(date);

            const dateFormatted = new Intl.DateTimeFormat("it-IT").format(date);
            return dateFormatted;
        },
    },
};
</script>

<style lang="scss">
div {
    h1 {
        text-transform: uppercase;
    }
}
</style>
