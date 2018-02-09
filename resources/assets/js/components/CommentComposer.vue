<template>
    <div class="row mt-2">
        <div class="column">
            <input v-model="message" />
        </div>
        <div class="column column-tiny ml-2">
            <button @click="send">New Comment</button>
        </div>
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
