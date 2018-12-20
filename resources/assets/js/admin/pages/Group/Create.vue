<template>
    <div class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" action="" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="name" required >
                        </div>

                        <div class="form-group">
                            <label>Systems</label>
                            <multiselect v-model="systems_selected"
                                :options="systems"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="true"
                                :hide-selected="true"
                                :preserve-search="false"
                                :preselect-first="true"
                                placeholder="Pick Systems"
                                track-by="name"
                                label="name" >
                                <template slot="tag" slot-scope="props">
                                    <span class="custom__tag badge badge-primary">
                                        <span>
                                            {{ props.option.name }}
                                        </span>
                                        <span class="custom__remove" @click="props.remove(props.option)">&times;</span>
                                    </span>
                                </template>
                            </multiselect>
                        </div>

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit"
                        class="btn btn-primary"
                        :disabled="loading"
                        @click="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    props: ['groups'],
    components: {
        Multiselect,
    },
    data() {
        return {
            name: null,
            loading: false,
            systems: [],
            systems_selected: [],
        }
    },
    mounted() {
        this.getSystems()
    },
    methods: {
        submit() {
            this.loading = true

            adminService.storeGroup({
                    name: this.name,
                    system: this.systems_selected
                })
                .then(response => {
                    this.loading = false
                    if(response.data.success) {
                        alertify.success('Successfully Added')
                        this.groups.push(response.data.group)
                        this.name = null
                        $(this.$el).modal('hide')
                    }
                })
                .catch(error => {
                    this.loading = false
                    if (error.response && error.response.status == 422) {
                        var error = error.response.data.errors
                        for ( var key in error ) {
                            _.each(error[key], (cr) => {
                                alertify.error(cr)
                            })
                        }
                    }else{
                        console.log(error)
                        // alertify.error(error.response.data.message)
                    }
                })
        },
        getSystems() {
            adminService.getSystemActive()
                .then(response => {
                    this.systems = response.data.systems
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<style lang="scss" scoped>
@import '~vue-multiselect/dist/vue-multiselect.min.css';

.custom__tag {
    // background-color: #58E3D3;
    padding: 4px 8px;
    border-radius: 10px;
    margin: 2px;
    display: inline-block;
}


.custom__remove {
    color: red;
    font-size: 12px;
    margin-left: 5px;
    font-weight: bold;
    cursor: pointer;

    &:hover {
        color: #AD0000;
    }
}

</style>
