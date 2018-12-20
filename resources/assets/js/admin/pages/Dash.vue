<template>
    <div class="row">
        <div class="__side">
            <side-nav></side-nav>
        </div>

        <div class="__page">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import SideNav from './General/SideNav.vue'
export default {
    components: {
        SideNav
    }
}
</script>

<style lang="css">
</style>
