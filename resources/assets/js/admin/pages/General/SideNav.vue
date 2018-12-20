<template>
    <ul>
        <li>
            <router-link to="/">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                Dashboard
            </router-link>
        </li>
        <li>
            <router-link to="/systems">
                <i class="fa fa-desktop" aria-hidden="true"></i>
                Systems
            </router-link>
        </li>
        <li>
            <router-link to="/groups">
                <i class="fa fa-users" aria-hidden="true"></i>
                Groups
            </router-link>
        </li>
        <li>
            <router-link to="/users">
                <i class="fa fa-users" aria-hidden="true"></i>
                Users
            </router-link>
        </li>
        <li>
            <router-link to="/accounts">
                <i class="fa fa-user" aria-hidden="true"></i>
                Accounts
            </router-link>
        </li>
    </ul>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>
li {
    list-style-type: none;
    padding: 4px;
    i {
        margin-right: 6px;
    }
}

a {
    text-decoration: none;
    color: #999;
    font-size: 16px;

    &:hover, &.active {
        color: #555;
    }
}
</style>
