<template>
    <div>
        <input v-model="message" />
        <button @click="send">Create</button>
    </div>
</template>

<script>
    export default {
        props: ['thread'],

        data() {
            return {
                message: ''
            }
        },

        methods: {
            send: function () {
                axios.post('/api/comments', {
                    thread: this.thread,
                    message: this.message
                }).then(response => {
                    this.message = ''
                }).catch(error => {
                    // Shit's on fire yo
                })
            }
        }
    }
</script>
