<template>
    <div class="p-3">

        <!-- <button class="btn btn-primary float-right" @click="create">Create</button> -->

        <h2>Users</h2>


        <table class="table table-bordered mt-2" ref="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="!users.length ">
                    <td colspan="4"><center>Empty</center></td>
                </tr> -->

                <items v-for="user in users"
                    :key="user.id"
                    :user="user"></items>
            </tbody>
        </table>
    </div>
</template>

<script>
import Items from './Items'
export default {
    components: {
        Items
    },
    data() {
        return {
            users: [],
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            adminService.getUsers()
                .then(response => {
                    this.users = response.data.users


                })
                .catch(error => {
                    console.log(error)
                })
        },
        // create() {
        //     $(this.$refs.create.$el).modal('show')
        // },
    },
}
</script>

<style lang="scss" scoped>
th:last-child {
    text-align: center;
    width: 100px;
}
</style>
