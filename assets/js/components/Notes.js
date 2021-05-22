import {mapGetters} from 'vuex'

import EditNoteModal from './EditNoteModal.vue'
import ViewNoteModal from './ViewNoteModal.vue'
import Note from '../models/Note.js'

export default {
    components: {EditNoteModal, ViewNoteModal},

    data: () => ({
        /**
         * @type {Note|null}
         */
        currentlyEditedNote: null,

        /**
         * @type {Note|null}
         */
        currentlyViewedNote: null,
    }),

    computed: mapGetters('note', {
        areNotesLoaded: 'areLoaded',
        notes: 'all',
    }),

    created() {
        this.$store.dispatch('note/load')
    },

    methods: {
        /**
         * @param {string} string
         * @param {number} length
         *
         * @return {string}
         */
        truncate(string, length) {
            return string.length > length ? string.substring(0, length) + '...' : string
        },

        add() {
            this.currentlyEditedNote = new Note()
        },

        /**
         * @param {Note} note
         */
        edit(note) {
            this.currentlyEditedNote = note.clone()
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

        /**
         * @param {Note} note
         */
        view(note) {
            this.currentlyViewedNote = note
        },

        reset() {
            this.currentlyEditedNote = this.currentlyViewedNote = null
        },
    },
}
