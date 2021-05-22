import Note from '../models/Note.js'

export default {
    props: {
        note: Note,
    },

    methods: {
        close() {
            this.$emit('close')
        },
    },
}
