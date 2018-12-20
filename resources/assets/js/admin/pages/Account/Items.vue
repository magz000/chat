<template>
    <tr>
        <td>{{ account.username }}</td>
        <td>{{ name }}</td>
        <td>{{ status }}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                Action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" @click="change">{{ changeStatus }}</a>
                <!-- <a class="dropdown-item" @click="deleteSystem">Delete</a> -->
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['account'],
    methods: {
        change() {
            adminService.changeStatusAccount(this.account.id)
                .then(response => {
                    if(response.data.success) {
                        this.account.status = response.data.account.status
                    }else {
                        alertify.error(response.data.message)
                    }
                })
                .catch(error => {
                    console.log(error)
                    alertify.error('Something went wrong')
                })

        },

    },
    computed: {
        name() {
            return this.account.first_name +' '+ this.account.last_name
        },
        status() {
            return this.account.status ? 'Active' : 'Inactive'
        },
        changeStatus() {
            return this.account.status ? 'Disable' : 'Enable'
        },
    }
}
</script>

<style lang="scss" scoped>
td:last-child {
    text-align: center;
    width: 100px;
}
a {
    cursor: pointer;
}
</style>
