<template>
    <li>
        {{ thread.created_at }} &middot; {{ thread.title }}
    </li>
</template>

<script>
    export default {
        props: ['thread']
    }
</script>
