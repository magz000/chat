<template>
    <div>
        <h2>Welcome! {{ getName }}</h2>

    </div>
</template>

<script>
export default {
    computed: {
        getName() {
            return this.user.first_name +' '+ this.user.last_name
        },
        user() {
            return this.$store.getters.user
        },
    }
}
</script>

<style lang="scss" scoped>
</style>
