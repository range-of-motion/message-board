<template>
    <ul class="threads">
        <thread v-for="thread in threads" v-bind:thread="thread" :key="thread.id"></thread>
    </ul>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                threads: this.data
            }
        },

        created() {
            window.Echo.channel('threads').listen('ThreadCreated', (e) => {
                console.log(e.created_at)
                this.threads.unshift({
                    id: e.id,
                    created_at: moment(e.created_at.date).format('YYYY-MM-DD HH:mm:ss'),
                    vote_count: 0,
                    title: e.title,
                    comments: []
                })
            })

            window.Echo.channel('threads').listen('ThreadDeleted', (e) => {
                for (var key in this.threads) {
                    if (this.threads[key].id == e.id) {
                        this.threads.splice(key, 1)
                    }
                }
            })

            window.Echo.channel('threads').listen('CommentCreated', (e) => {
                this.threads.forEach(thread => {
                    if (thread.id == e.thread) {
                        thread.comments.push({
                            id: e.id,
                            created_at: moment(e.created_at.date).format('YYYY-MM-DD HH:mm:ss'),
                            vote_count: 0,
                            message: e.message
                        });
                    }
                })
            })

            window.Echo.channel('threads').listen('CommentDeleted', (e) => {
                for (var x in this.threads) {
                    for (var y in this.threads[x].comments) {
                        if (this.threads[x].comments[y].id == e.id) {
                            this.threads[x].comments.splice(y, 1)
                        }
                    }
                }
            })

            window.Echo.channel('threads').listen('VoteCountUpdated', (e) => {
                if (e.target_type == 'thread') {
                    for (var x in this.threads) {
                        var thread = this.threads[x]

                        if (thread.id == e.target_id) {
                            thread.vote_count = e.vote_count
                        }
                    }
                } else if (e.target_type == 'comment') {
                    for (var x in this.threads) {
                        var thread = this.threads[x]

                        for (var y in thread.comments) {
                            var comment = thread.comments[y];

                            if (comment.id == e.target_id) {
                                comment.vote_count = e.vote_count
                            }
                        }
                    }
                }
            })
        }
    }
</script>
