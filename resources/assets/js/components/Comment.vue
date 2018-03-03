<template>
    <li>
        <div>{{ blyat }} &middot; VOTE_COUNT_PLACEHOLDER</div>
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
