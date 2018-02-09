<template>
    <div>
        <div class="row mb-2">
            <div class="column">
                <input v-model="title" />
            </div>
            <div class="column column-tiny ml-2">
                <button @click="createThread">New Thread</button>
                <i v-if="loading" class="fa fa-circle-o-notch fa-spin" style="margin-left: 4px;"></i>
            </div>
        </div>
        <div class="mb-2" v-if="error">
            <div class="error">Something went wrong</div>
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

                    this.error = true
                })
            }
        }
    }
</script>
