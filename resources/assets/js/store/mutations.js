export default {
    setUser: (state, user) => {
        state.user = user
    },
    setConversations: (state, conversations) => {
        state.conversations = conversations
    },
    // addConversation: (state, conversation) => {
    //     state.conversations.push(conversation)
    // },
    addConversation: (state, conversation) => {
        state.conversations = _.filter(state.conversations, (c) => {
            return c.id != conversation.id
        })

        state.conversations.push(conversation)
    },
    setOnlines: (state, users) => {
        state.onlines = users
    },
    userJoining: (state, user) => {
        state.onlines.push(user)
    },
    userLeaving: (state, user) => {
        state.onlines = _.filter(state.onlines, (o) => {
            return o.id != user.id
        })
    },
    setUsers(state, users) {
        state.users = users
    },

    //
    setSelectedConv: (state, conv) => {
        state.selectedConv = conv
    },
    setSelectedConvType: (state, type) => {
        state.selectedConvType = type
    },
}
