import ApiError from '../errors/ApiError.js'
import ApiValidationError from '../errors/ApiValidationError.js'
import Note from '../models/Note.js'

const noErrors = () => ({global: [], fields: {}})

export default {
    props: {
        note: Note,
    },

    data: () => ({
        /**
         * @type {Note}
         */
        dirtyNote: null,

        /**
         * @type {Object}
         */
        errors: noErrors(),
    }),

    created() {
        this.dirtyNote = this.note.isNew() ? this.note : this.note.clone()
    },

    methods: {
        close() {
            this.$emit('close')
        },

        async save() {
            this.resetErrors()

            try {
                let action = this.dirtyNote.isNew() ? 'note/create' : 'note/update'

                await this.$store.dispatch(action, this.dirtyNote)

                this.close()
            } catch (error) {
                this.handleApiError(error)
            }
        },

        resetErrors() {
            this.errors = noErrors()
        },

        handleApiError(error) {
            if (!(error instanceof ApiError)) {
                throw error
            }

            if (error instanceof ApiValidationError) {
                this.errors.global.concat(error.getGlobalViolationTitles())
                Object.assign(this.errors.fields, error.getFieldsViolationTitles())
            } else {
                this.errors.global.push('Unknown error occurred. Please try again.')
            }
        },
    },
}
