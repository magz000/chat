<template>
    <div class="__main">
        <navigation></navigation>
        <router-view></router-view>
    </div>
</template>


<script>
import Navigation from './General/Navigation.vue'
export default {
    components: {
        Navigation
    }
}
</script>

<style>
.__main {
    padding-top: 55px;
    height: 100vh;
}
</style>
