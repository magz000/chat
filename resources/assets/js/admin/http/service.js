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

    //systems crud
    getSystems: () => {
        return client.get('system')
    },
    getSystemActive: () => {
        return client.get('system/active')
    },
    storeSystem: (params) => {
        return client.post('system', params)
    },
    updateSystem: (id, params) => {
        return client.patch(`system/${id}`, params)
    },
    deleteSystem: (id) => {
        return client.delete(`system/${id}`)
    },

    //group crud
    getGroups: () => {
        return client.get('group')
    },
    storeGroup: (params) => {
        return client.post('group', params)
    },
    updateGroup: (id, params) => {
        return client.patch(`group/${id}`, params)
    },
    changeStatusGroup: (id) => {
        return client.patch(`group/${id}/status`)
    },
    deleteGroup: (id) => {
        return client.delete(`group/${id}`)
    },

    //accounts crud
    getAccounts: () => {
        return client.get('account')
    },
    storeAccount: (params) => {
        return client.post('account', params)
    },
    updateAccount: (id, params) => {
        return client.patch(`account/${id}`, params)
    },
    changeStatusAccount: (id) => {
        return client.patch(`account/${id}/status`)
    },

    //users
    getUsers: () => {
        return client.get('user/json')
    },
    changeStatusUser: (id) => {
        return client.patch(`user/${id}/status`)
    },




}
