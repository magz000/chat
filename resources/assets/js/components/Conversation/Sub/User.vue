<template>
    <li>
        <img :src="image">
        {{user.name}} <i class="fa fa-circle" :class="{ online: user.online }"></i>
    </li>
</template>

<script>
    export default {
        props: ['user', 'online'],
        mounted() {

        },
        computed: {
            status() {
                if(this.user.online){
                    return '(online)'
                }else {
                    return '(offline)'
                }
            },
            image() {
                return this.user.image ? this.user.image : '/images/profile-placeholder.png'
            },
        }
    }
</script>

<style lang="scss" scoped>
    li {
        padding: 10px;
        list-style:none ;
    }

    .fa {
        float: right;
        color: #ccc;

        &.online {
            color: #39D171;
        }
    }
</style>
