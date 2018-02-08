<template>
    <li>
        {{ created_at }} &middot; {{ title }}
    </li>
</template>

<script>
    export default {
        props: ['created_at', 'title']
    }
</script>
