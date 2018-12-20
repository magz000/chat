export const store = {
    _token: null,
    _user: null,

    isLogged() {
        return this.token
    },
    clear() {
        // localStorage.clear()
        this._token = null
        localStorage.removeItem('admin_token')
        localStorage.removeItem('admin_user')
    },
    set token(str) {
        this._token = str
        localStorage.setItem('admin_token', str)
    },

    get token() {
        // return this._token || localStorage.getItem('853993918da4a36ac9db8aba884ac238')
        return localStorage.getItem('admin_token')
    },

    set user(usr) {
        this._user = usr
        localStorage.setItem('admin_user', JSON.stringify(usr))
    },

    get user() {
        return this._user || JSON.parse(localStorage.getItem('admin_user'))
    },


}
