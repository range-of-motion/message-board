<template>
    <li>
        <div class="row">
            <div class="column">
                <div>{{ blyat }}</div>
                <div style="margin-top: 24px;">{{ comment.message }}</div>
            </div>
            <div class="column column-tiny text-align-center">
                <button class="small" @click="vote(1)">
                    <i class="fa fa-arrow-up"></i>
                </button>
                <div class="vote_count">{{ comment.vote_count }}</div>
                <button class="small" @click="vote(0)">
                    <i class="fa fa-arrow-down"></i>
                </button>
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
        },

        methods: {
            vote: function (type) {
                var self = this

                axios.post('/api/votes', {
                    target_id: self.comment.id,
                    target_type: 'comment',
                    type: type
                }).then(function (response) {
                    //
                }).catch(function (error) {
                    //
                })
            }
        }
    }
</script>
