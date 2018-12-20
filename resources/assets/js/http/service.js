import client from './client'

export const service = {
    login: (params) => {
        return client.post('login', params)
    },
    refreshToken: () => {
        return client.post('refresh')
    },
    getUser: () => {
        return client.get('user')
    },
    getUsers: () => {
        return client.get('users')
    },
    getConversations: () => {
        return client.get('conversation')
    },
    createConversation: (params) => {
        return client.post('conversation', params)
    },
    getMessages: (id, page) => {
        return client.get(`conversation/${ id }/messages`, {
            params: {
                page: page,
            }
        })
    },
    markAsRead: (id) => {
        return client.post(`conversation/${ id }/read`)
    },
    sendMessage: (params) => {
        // return client.post('conversation/' + id + '/send', params, {
        return client.post('conversation/send', params, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        })
    },
    changeTitle: (id, params) => {
        return client.patch(`conversation/${id}`, params)
    },
    addUser: (id, params) => {
        return client.post(`conversation/${id}/add`, params)
    },

}
