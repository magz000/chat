<template>
    <!-- <router-link :to="'/user/' + user.id"  v-if="isSearched"> -->
    <div class="col-12 __conv-item" :class="{active: isActive}" @click="setSelected" v-if="isSearched">
        <div class="avatar"  :style="bg"></div>

        <i class="fa fa-circle" :class="{ online: isOnline }"></i>

        <span class="name">{{ title }}</span>
        <br>

        <p>&nbsp;</p>
    </div>
<!-- </router-link> -->

</template>

<script>
export default {
    props: ['user', 'search'],
    mounted() {

    },
    methods: {
        setSelected(){
            this.$store.commit('setSelectedConv', this.user)
            this.$store.commit('setSelectedConvType', 'user')
        }
    },
    computed: {
        title(){
            return this.user.first_name +' '+ this.user.last_name
        },
        onlines() {
            return this.$store.getters.onlines
        },
        isOnline() {
            return _.find(this.onlines, (o) => {
                return o.id == this.user.id
            })
        },
        isSearched() {
            if(this.search && this.search.length) {
                return this.title.toLowerCase().includes(this.search.toLowerCase())
            } else {
                return true
            }
        },
        selected() {
            return this.$store.getters.selectedConv
        },
        type() {
            return this.$store.getters.selectedConvType
        },
        isActive() {
            if(this.selected)
            return this.user.id == this.selected.id && this.type == 'user'
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

.__conv-item {
    background: #fff;
    padding: 10px;
    font-size: 12px;
    border-top: 1px solid #cccccc;
    cursor: pointer;

    &:hover {
        background: #eee;
    }

    &.active {
        background: #efefef;
    }
}


a {
    text-decoration: none;
}

.name {
    color: #515151;
    font-weight: bold;
}

p {
    color: #aaa;
    margin-bottom: 0px;
}

.fa {
    color: #ccc;
    position:absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);

    &.online {
        color: #39D171;
    }
}

</style>
