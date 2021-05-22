import {mapGetters} from 'vuex'

import NoteModal from './NoteModal.vue'
import store from '../store/index.js'

export default {
    components: {NoteModal},

    computed: mapGetters('note', {
        areNotesLoaded: 'areLoaded',
        notes: 'all',
    }),

    created() {
        store.dispatch('note/load')
    },
}
