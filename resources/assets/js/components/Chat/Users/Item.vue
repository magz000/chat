<template>
    <div class="__user">
        <div class="avatar"  :style="bg"></div>

        {{ formatName }}
        <i class="fa fa-circle" :class="{ online: isOnline }"></i>
    </div>
</template>

<script>
export default {
    props: ['user'],
    computed: {
        isOnline() {
            return _.find(this.onlines, {'id': this.user.id})
        },
        formatName() {
            return this.user.first_name +' '+ this.user.last_name
        },
        onlines() {
            return this.$store.getters.onlines
        },
        image() {
            return this.user.image ? this.user.image.link : '/images/profile-placeholder.png'
        },
        bg() {
            return {
                background: `url('${this.image}')` ,
                marginRight: `10px`,
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.__user {
    padding: 12px 5px;
}

.fa {
    float: right;
    color: #ccc;

    &.online {
        color: #39D171;
    }
}
</style>
