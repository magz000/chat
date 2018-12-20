<template>
    <div class="p-3">

        <button class="btn btn-primary float-right" @click="create">Create</button>

        <h2>Accounts</h2>


        <table class="table table-bordered mt-2">
            <thead>
                <th>Username</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-if="!accounts.length ">
                    <td colspan="4"><center>Empty</center></td>
                </tr>

                <items v-else v-for="account in accounts"
                    :key="account.id"
                    :account="account"></items>
            </tbody>
        </table>

        <create ref="create" :accounts="accounts"></create>
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
            accounts: [],
        }
    },
    mounted() {
        this.getAccounts()
    },
    methods: {
        getAccounts() {
            adminService.getAccounts()
                .then(response => {
                    this.accounts = response.data.accounts
                })
                .catch(error => {
                    console.log(error)
                })
        },
        create() {
            $(this.$refs.create.$el).modal('show')
        },
        // removeSystem(id) {
        //     this.systems = _.filter(this.systems, (s) => {
        //         return s.id != id
        //     })
        // }
    },
}
</script>

<style lang="scss" scoped>
th:last-child {
    text-align: center;
    width: 100px;
}
</style>
