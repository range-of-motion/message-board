<template>
    <div>
        <div class="row mt-2">
            <div class="column">
                <input v-model="message" @keyup.enter="send" />
            </div>
            <div class="column column-tiny ml-2">
                <button @click="send" class="w-160">
                    <span v-if="!loading">New Comment</span>
                    <i v-if="loading" class="fa fa-circle-o-notch fa-spin"></i>
                </button>
            </div>
        </div>
        <div class="mt-2" v-if="error">
            <div class="error">{{ error }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['thread'],

        data() {
            return {
                message: '',
                error: false,
                loading: false
            }
        },

        methods: {
            send: function () {
                this.loading = true

                axios.post('/api/comments', {
                    thread: this.thread,
                    message: this.message
                }).then(response => {
                    this.message = ''

                    this.error = false

                    this.loading = false
                }).catch(error => {
                    if (error.response.status == 429) {
                        this.error = 'You can comment every 10 seconds, please wait'
                    } else {
                        this.error = 'Something went wrong, you probably forgot something'
                    }

                    this.loading = false
                })
            }
        }
    }
</script>
