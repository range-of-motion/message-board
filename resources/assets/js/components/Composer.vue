<template>
    <div>
        <input v-model="title" />
        <button @click="createThread">Create</button>
        <i v-if="loading" class="fa fa-circle-o-notch fa-spin" style="margin-left: 4px;"></i>
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
