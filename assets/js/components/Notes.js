import {mapGetters} from 'vuex'

import NoteModal from './NoteModal.vue'
import Note from '../models/Note.js'

export default {
    components: {NoteModal},

    data: () => ({
        /**
         * @type {Note|null}
         */
        currentNote: null,
    }),

    computed: mapGetters('note', {
        areNotesLoaded: 'areLoaded',
        notes: 'all',
    }),

    created() {
        this.$store.dispatch('note/load')
    },

    methods: {
        add() {
            this.currentNote = new Note()
        },

        /**
         * @param {Note} note
         */
        edit(note) {
            this.currentNote = note.clone()
        },

        /**
         * @param {Note} note
         */
        async remove(note) {
            let result = confirm('Are you sure you want to remove the note?')

            if (!result) {
                return
            }

            try {
                await this.$store.dispatch('note/delete', note)
            } catch (error) {
                alert('Error occurred while trying to remove the note. Please refresh the page or try again later.')
            }
        },

        reset() {
            this.currentNote = null
        },
    },
}
