import {mapGetters} from 'vuex'

import NoteModal from './NoteModal.vue'
import Note from '../models/Note.js'
import store from '../store/index.js'

export default {
    components: {NoteModal},

    data: () => ({
        note: new Note()
    }),

    computed: mapGetters('note', {
        areNotesLoaded: 'areLoaded',
        notes: 'all',
    }),

    created() {
        store.dispatch('note/load')
    },
}
