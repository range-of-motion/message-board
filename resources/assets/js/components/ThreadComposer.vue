<template>
    <div>
        <div class="row mb-2">
            <div class="column">
                <input v-model="title" @keyup.enter="createThread" />
            </div>
            <div class="column column-tiny ml-2">
                <button @click="createThread" class="w-144">
                    <span v-if="!loading">New Thread</span>
                    <i v-if="loading" class="fa fa-circle-o-notch fa-spin"></i>
                </button>
            </div>
        </div>
        <div class="mb-2" v-if="error">
            <div class="error">{{ error }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                title: '',
                error: false
            }
        },

        methods: {
            createThread: function () {
                this.loading = true

                axios.post('/api/threads', {
                    title: this.title
                }).then(response => {
                    this.title = ''

                    this.loading = false

                    this.error = false
                }).catch(error => {
                    this.loading = false

                    if (error.response.status == 429) {
                        this.error = 'You can create a new thread every 60 seconds, please wait'
                    } else {
                        this.error = 'Something went wrong, you probably forgot something'
                    }
                })
            }
        }
    }
</script>
