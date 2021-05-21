import authentication from '../user/authentication.js'

export default {
    methods: {
        async logout() {
            await authentication.logout()
        },
    },
}
