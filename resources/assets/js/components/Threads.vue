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
                this.threads.unshift({
                    id: e.id,
                    created_at: moment(e.created_at.date).format('YYYY-MM-DD HH:mm:ss'),
                    title: e.title,
                    comments: []
                })
            })

            window.Echo.channel('threads').listen('CommentCreated', (e) => {
                this.threads.forEach(thread => {
                    if (thread.id == e.thread) {
                        thread.comments.push({
                            created_at: moment(e.created_at.date).format('YYYY-MM-DD HH:mm:ss'),
                            message: e.message
                        });
                    }
                })
            })
        }
    }
</script>
