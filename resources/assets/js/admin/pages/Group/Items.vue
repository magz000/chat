<template>
    <tr>
        <td>{{ group.name }}</td>
        <td>
            <ul>
                <li v-for="system in group.system">{{ system.name }}</li>
            </ul>
        </td>
        <td>{{ status }}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                Action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" @click="change">{{ changeStatus }}</a>
                <a class="dropdown-item" @click="deleteGroup">Delete</a>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['remove', 'group'],
    methods: {
        change() {
            adminService.changeStatusGroup(this.group.id)
                .then(response => {
                    if(response.data.success) {
                        this.group.status = response.data.group.status
                    }else {
                        alertify.error(response.data.message)
                    }
                })
                .catch(error => {
                    console.log(error)
                    alertify.error('Something went wrong')
                })

        },
        deleteGroup() {
            adminService.deleteGroup(this.group.id)
                .then(response => {
                    if(response.data.success) {
                        this.remove(this.group.id)
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
            return this.group.status ? 'Active' : 'Inactive'
        },
        changeStatus() {
            return this.group.status ? 'Disable' : 'Enable'
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
