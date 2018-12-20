<template>
    <li>
        <p class="time">{{getDate}}</p>
        <b>{{message.sender.name}}</b>
        <p v-if="message.type == 'text'">{{message.body}}</p>
        <img v-if="message.type == 'image' " :src="'/storage/' + getObject.path">

        <a class="file" v-if="message.type == 'file'" :href="'/storage/' + getObject.path" target="_blank" :download="getObject.filename">{{ getObject.filename }}</a>
    </li>
</template>

<script>
    export default {
        props: ['message'],
        mounted() {

        },
        computed: {
            getObject(){
                if(this.message.type != 'text'){
                    var obj = JSON.parse(this.message.body)

                    return obj
                }
            },
            getDate(){
                return moment(this.message.created_at).calendar();
            }
        }
    }
</script>

<style lang="scss" scoped>
    li{
        position: relative;
    }
    img {
        display: block;
        height: 70px;
        margin-bottom: 16px;
    }

    .file {
        display: block;
        margin-bottom: 16px;
    }

    .time {
        float: right;
        font-size: 10px;
    }
</style>
