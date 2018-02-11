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
            <div class="error">Something went wrong</div>
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
                    this.error = true

                    this.loading = false
                })
            }
        }
    }
</script>
