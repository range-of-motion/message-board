<template>
    <li>
        <div class="row">
            <div class="column">
                <div>{{ blyat }}</div>
                <div style="margin-top: 24px;">{{ comment.message }}</div>
            </div>
            <div class="column column-tiny text-align-center">
                <div class="vote_count">{{ comment.vote_count }}</div>
            </div>
        </div>
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
