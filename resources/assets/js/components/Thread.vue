<template>
    <li>
        <div>{{ thread.created_at }} &middot; {{ thread.title }}</div>
        <div class="mt-2" v-if="collapsedComments && thread.comments.length > 3">
            <button class="wide" @click="toggleCollapse">Show {{ thread.comments.length - 3 }} more</button>
        </div>
        <div class="mt-2" v-if="!collapsedComments && thread.comments.length > 3">
            <button class="wide" @click="toggleCollapse">Hide {{ thread.comments.length - 3 }} again</button>
        </div>
        <ul class="comments">
            <li v-for="(comment, index) in thread.comments" v-if="!collapsedComments || index >= thread.comments.length - 3">{{ comment.created_at }} &middot; {{ comment.message }}</li>
        </ul>
        <comment-composer v-bind:thread="thread.id"></comment-composer>
    </li>
</template>

<script>
    export default {
        props: ['thread'],

        data() {
            return {
                collapsedComments: true
            }
        },

        methods: {
            toggleCollapse: function () {
                this.collapsedComments = !this.collapsedComments
            }
        }
    }
</script>
