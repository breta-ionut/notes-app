import {mapState} from 'vuex'

export default {
    computed: {
        ...mapState(['activeModal']),
        ...mapState('user', {userLoading: state => !state.userLoaded}),
    },
}
