import {mapGetters} from 'vuex'

import store from '../store/index.js'

export default {
    computed: mapGetters('note', {
        areNotesLoaded: 'areLoaded',
        notes: 'all',
    }),

    created() {
        store.dispatch('note/load')
    },
}
