<template>
    <li>
        <div class="row">
            <div class="column">
                <div>{{ blyat }}</div>
                <div style="margin-top: 24px;">{{ thread.title }}</div>
            </div>
            <div class="column column-tiny text-align-center">
                <button class="small" @click="vote(1)">
                    <i class="fa fa-arrow-up"></i>
                </button>
                <div class="vote_count">{{ thread.vote_count }}</div>
                <button class="small" @click="vote(0)">
                    <i class="fa fa-arrow-down"></i>
                </button>
            </div>
        </div>
        <div class="mt-2" v-if="collapsedComments && thread.comments.length > 3">
            <button class="wide" @click="toggleCollapse">Show {{ thread.comments.length - 3 }} more</button>
        </div>
        <div class="mt-2" v-if="!collapsedComments && thread.comments.length > 3">
            <button class="wide" @click="toggleCollapse">Hide {{ thread.comments.length - 3 }} again</button>
        </div>
        <ul class="comments">
            <comment v-for="(comment, index) in thread.comments" v-if="!collapsedComments || index >= thread.comments.length - 3" :comment="comment"></comment>
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

        computed: {
            blyat: function () {
                return moment(this.thread.created_at).format('DD-MM HH:mm')
            }
        },

        methods: {
            toggleCollapse: function () {
                this.collapsedComments = !this.collapsedComments
            },

            vote: function (type) {
                var self = this

                axios.post('/api/votes', {
                    target_id: self.thread.id,
                    target_type: 'thread',
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
