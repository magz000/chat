<template>
    <div class="__main">
        <navigation></navigation>

        <div class="container">
            <router-view></router-view>
            <!-- <div class="row">
                <div class="__side">
                    <side-nav></side-nav>
                </div>

                <div class="__page">
                    <div class="container">
                        <router-view></router-view>
                    </div>
                </div>
            </div> -->
        </div>

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

.__side {
    width: 200px;
    padding: 20px;
}

.__page {
    flex: 1;
    padding: 20px;
}
</style>
