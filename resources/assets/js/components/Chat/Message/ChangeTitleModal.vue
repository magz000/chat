<template>
    <div class="modal fade" id="change-title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input class="form-control" v-model="title">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['conversation'],
        data(){
            return {
                title: this.conversation.data.title ,
            }
        },
        watch: {
            conversation() {
                this.title = this.conversation.data.title
            }
        },
        mounted() {

        },
        methods: {
            submit() {
                chatService.changeTitle(this.conversation.id, {
                    title: this.title,
                })
                .then(response => {
                    this.conversation.data = response.data.conversation.data
                    console.log(response.data)
                    $(this.$el).modal('hide')
                })
                .catch(error => {
                    console.log(error)
                })
            },
        },
    }
</script>
