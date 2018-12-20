<template>
    <tr>
        <td>{{ user.email }}</td>
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
    props: ['user'],
    methods: {
        change() {
            adminService.changeStatusUser(this.user.id)
                .then(response => {
                    if(response.data.success) {
                        this.user.status = response.data.user.status
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
            return this.user.first_name +' '+ this.user.last_name
        },
        status() {
            return this.user.status ? 'Active' : 'Inactive'
        },
        changeStatus() {
            return this.user.status ? 'Disable' : 'Enable'
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
