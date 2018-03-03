<template>
    <li>
        {{ comment.created_at }} &middot; {{ comment.message }}
    </li>
</template>

<script>
    export default {
        props: ['comment']
    }
</script>
