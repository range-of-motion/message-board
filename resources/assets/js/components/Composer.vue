<template>
    <div>
        <input v-model="title" />
        <div v-if="!loading">
            <button @click="createThread">Create</button>
        </div>
        <div v-if="loading">
            ...
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                title: ''
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
                }).catch(error => {
                    // Shit's on fire yo

                    this.loading = false
                })
            }
        }
    }
</script>
