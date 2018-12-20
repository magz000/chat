<template>
    <div class="__message" :class="{me: isMine}">
        <!-- <p class="time">{{getDate}}</p> -->
        <b class="__name" v-if="!prev || message.sender.id != prev.sender.id">{{message.sender.name}}</b>

        <div class="clearfix">
            <div class="__content" :title="getDate">
                <pre v-if="message.type == 'text'">{{ message.body }}</pre>

                <img v-if="message.type == 'image' " :src="'/storage/' + getObject.path">

                <a class="file"
                    v-if="message.type == 'file'"
                    :href="'/storage/' + getObject.path"
                    target="_blank"
                    :download="getObject.filename">{{ getObject.filename }}</a>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['message', 'prev'],
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
            },
            isMine(){
                return this.user.email == this.message.sender.email
            },
            user() {
                return this.$store.getters.user
            }
        }
    }
</script>

<style lang="scss" scoped>
    .__message {
        display: block;
        margin: 5px;

        .__name {
            font-size: 12px;
        }


        .__content {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 10px 10px 10px 0px;
            background: #efefef;
            max-width: 60%;

            pre {
                font-family: "Open Sans", sans-serif;
                word-wrap: break-word;
                white-space: pre-wrap;
            }
        }


        &.me {
            text-align: right;

            .__content {
                text-align: left;
                float: right;
                color: #fff;
                border-radius: 10px 10px 0px 10px;
                background: #3577e6;


                pre {
                    color: #fff;
                }
            }
        }
    }

    p, pre {
        margin-bottom: 0px;
    }

    li{
        position: relative;
    }

    img {
        display: block;
        height: 70px;
    }

    .file {
        display: block;
    }

    .time {
        float: right;
        font-size: 10px;
    }
</style>
