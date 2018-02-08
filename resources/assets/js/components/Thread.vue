<template>
    <li>
        {{ thread.created_at }} &middot; {{ thread.title }}
        <ul class="comments">
            <li v-for="comment in thread.comments">{{ comment.created_at }} &middot; {{ comment.message }}</li>
        </ul>
        <comment-composer v-bind:thread="thread.id"></comment-composer>
    </li>
</template>

<script>
    export default {
        props: ['thread']
    }
</script>
