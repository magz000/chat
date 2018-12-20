export const store = {
    _token: null,
    _user: null,

    isLogged() {
        return this.token
    },
    clear() {
        // localStorage.clear()
        this._token = null
        localStorage.removeItem('853993918da4a36ac9db8aba884ac238')
        localStorage.removeItem('chat_user')
    },
    set token(str) {
        this._token = str
        localStorage.setItem('853993918da4a36ac9db8aba884ac238', str)
    },

    get token() {
        // return this._token || localStorage.getItem('853993918da4a36ac9db8aba884ac238')
        return localStorage.getItem('853993918da4a36ac9db8aba884ac238')
    },

    set user(usr) {
        this._user = usr
        localStorage.setItem('chat_user', JSON.stringify(usr))
    },

    get user() {
        return this._user || JSON.parse(localStorage.getItem('chat_user'))
    },


}
