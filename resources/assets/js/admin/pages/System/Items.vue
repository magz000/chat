<template>
    <tr>
        <td>{{ system.name }}</td>
        <td>{{ status }}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                Action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" @click="change">{{ changeStatus }}</a>
                <a class="dropdown-item" @click="deleteSystem">Delete</a>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['remove', 'system'],
    methods: {
        change() {
            var params = {
                'name': this.system.name,
                'status': this.system.status ? 0 : 1
            }

            adminService.updateSystem(this.system.id, params)
                .then(response => {
                    if(response.data.success) {
                        this.system.status = response.data.system.status
                    }else {
                        alertify.error(response.data.message)
                    }
                })
                .catch(error => {
                    console.log(error)
                    alertify.error('Something went wrong')
                })

        },
        deleteSystem() {
            adminService.deleteSystem(this.system.id)
                .then(response => {
                    if(response.data.success) {
                        this.remove(this.system.id)
                        // this.system.status = response.data.system.status
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
        status() {
            return this.system.status ? 'Active' : 'Inactive'
        },
        changeStatus() {
            return this.system.status ? 'Disable' : 'Enable'
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
