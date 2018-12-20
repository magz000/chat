<template >
    <div class="__input-cont">
        <div class="clearfix">
            <span class="__attach" @click="addFile"><i class="fa fa-paperclip"></i></span>
        </div>
        <!-- <input class="form-control"
                v-model="message"
                :style="{display: !fileCont ? 'block': 'none'}"
                @keypress.enter="send"> -->

        <textarea class="form-control"
                ref="textArea"
                v-model="message"
                :style="{display: !fileCont ? 'block': 'none'}"
                @keypress.enter.prevent="send"
                @keyup.alt.enter="nextLine"
                @keyup.ctrl.enter="nextLine"
                @keyup="autoSize"></textarea>

        <input id="file-input"
                type="file"
                class="form-control-file"
                :style="{display: fileCont ? 'block': 'none'}"
                @change="processFile">

        <button class="btn btn-danger" :style="{display: fileCont ? 'block': 'none'}" @click="removeFile">Remove</button>

        <div class="clearfix">
            <span class="__send" @click="send"><i class="fa fa-send"></i></span>
        </div>
    </div>
</template>

<script>
export default {
    // props: ['conversation'],
    data() {
        return {
            message: '',
            fileCont: null,
        }
    },
    watch: {
        'conversation.id': {
            immediate: true,
            handler: function(val, old){
                this.message = ''
            }
        },
        message(){
            if(this.type == 'conversation') {
                Echo.private('conversation.' + this.conversation.id)
                    .whisper('typing', {
                        user: this.user.first_name +' '+ this.user.last_name,
                        message: this.message,
                    })
            }
        }
    },
    mounted() {

    },
    methods: {
        send(){
            var formData = new FormData();

            if(this.fileCont) {
                formData.append("upl", this.fileCont)
            }else {
                if(!this.message.trim().length) {
                    alertify.error('Please enter something')
                    return false
                }
                formData.append("message", this.message)
            }

            if(this.type == 'conversation') {
                formData.append("conversation_id", this.conversation.id)
            }else if(this.type == 'user') {
                formData.append("users", [this.conversation.id]);
            }else if(this.type == 'users') {
                formData.append("users", _.map(this.conversation, 'id'))
            }

            chatService.sendMessage(formData)
            .then(response => {
                this.fileCont = null

                if(this.type == 'user' || this.type == 'users') {
                    this.$store.commit('addConversation', response.data.conversation)
                    this.$store.commit('setSelectedConv', response.data.conversation)
                    this.$store.commit('setSelectedConvType', 'conversation')
                    // this.$router.push('/conversation/' + response.data.conversation.id)
                }

            })
            .catch(error => {
                console.log(error)
            })
            this.message = ''
            $('#file-input').val('')
        },
        processFile(event) {
            this.fileCont = event.target.files[0]
        },
        addFile(){
            $('#file-input').click()
        },
        removeFile() {
            this.fileCont = null
            $('#file-input').val('')
        },
        nextLine() {
            this.message += '\n'
        },
        autoSize() {
            var element = this.$refs.textArea
            element.style.height = "40px";
            element.style.height  = element.scrollHeight + 'px'
            // element.style.height = (element.scrollHeight > 120 ? 120 : element.scrollHeight)+"px";
        },
    },
    computed: {
        user() {
            return this.$store.getters.user
        },
        conversation() {
            return this.$store.getters.selectedConv
        },
        type() {
            return this.$store.getters.selectedConvType
        },
    }
}
</script>

<style lang="scss" scoped>
.__input-cont {
    width: 100%;
    padding: 5px 10px;
    display: flex;
    flex-direction: row;

    .__attach, .__send {
        width: 30px;
        font-size: 20px;
        text-align: center;
        color: #bbb;

        i {
            transform: rotate(45deg);
        }

        &:hover {
            color: #555;
        }


    }

    input, textarea {
        height: 40px;
        min-height: 40px;
        max-height: 120px;
        flex: 1;
        border-radius: 15px;
        font-size: 11px;
        margin: 0px 10px;

    }
}
</style>
