<template>
    <li>
        <div>{{ blyat }} &middot; {{ comment.vote_count }}</div>
        <div style="margin-top: 24px;">{{ comment.message }}</div>
    </li>
</template>

<script>
    export default {
        props: ['comment'],

        computed: {
            blyat: function () {
                return moment(this.comment.created_at).format('DD-MM HH:mm')
            }
        }
    }
</script>
