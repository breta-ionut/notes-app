import Note from '../models/Note.js'

export default {
    props: {
        note: Note,
    },

    created() {
        this.$store.commit('activateModal')
    },

    methods: {
        close() {
            this.$emit('close')
            this.$store.commit('deactivateModal')
        },
    },
}
