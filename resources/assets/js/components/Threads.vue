<template>
    <ul class="threads">
        <thread v-for="thread in threads" v-bind:thread="thread"></thread>
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
                    created_at: e.created_at.date,
                    title: e.title
                })
            })
        }
    }
</script>
