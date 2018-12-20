<template>
    <div class="p-3">

        <button class="btn btn-primary float-right" @click="create">Create</button>

        <h2>Groups</h2>


        <table class="table table-bordered mt-2">
            <thead>
                <th>Name</th>
                <th>Systems</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-if="!groups.length ">
                    <td colspan="4"><center>Empty</center></td>
                </tr>

                <items v-else v-for="group in groups"
                    :key="group.id"
                    :group="group"
                    :remove="removeGroup"></items>
            </tbody>
        </table>

        <create ref="create" :groups="groups"></create>
    </div>
</template>

<script>
import Items from './Items'
import Create from './Create'
export default {
    components: {
        Items, Create
    },
    data() {
        return {
            groups: [],
        }
    },
    mounted() {
        this.getGroups()
    },
    methods: {
        getGroups() {
            adminService.getGroups()
                .then(response => {
                    this.groups = response.data.groups
                })
                .catch(error => {
                    console.log(error)
                })
        },
        create() {
            $(this.$refs.create.$el).modal('show')
        },
        removeGroup(id) {
            this.groups = _.filter(this.groups, (g) => {
                return g.id != id
            })
        }
    },
}
</script>

<style lang="scss" scoped>
th:last-child {
    text-align: center;
    width: 100px;
}
</style>
