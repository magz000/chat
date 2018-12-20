<template>
    <div class="p-3">

        <button class="btn btn-primary float-right" @click="create">Create</button>

        <h2>Systems</h2>


        <table class="table table-bordered mt-2">
            <thead>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-if="!systems.length ">
                    <td colspan="4"><center>Empty</center></td>
                </tr>

                <items v-else v-for="system in systems"
                    :key="system.id"
                    :system="system"
                    :remove="removeSystem"></items>
            </tbody>
        </table>

        <create ref="create" :systems="systems"></create>
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
            systems: [],
        }
    },
    mounted() {
        this.getSystems()
    },
    methods: {
        getSystems() {
            adminService.getSystems()
                .then(response => {
                    this.systems = response.data.systems
                })
                .catch(error => {
                    console.log(error)
                })
        },
        create() {
            $(this.$refs.create.$el).modal('show')
        },
        removeSystem(id) {
            this.systems = _.filter(this.systems, (s) => {
                return s.id != id
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
