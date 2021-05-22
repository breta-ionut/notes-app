import Note from './Note.js'

export default class NoteCollection {
    /**
     * @type {Object}
     *
     * @private
     */
    notes = {}

    /**
     * @param {Array} data
     *
     * @returns {NoteCollection}
     */
    static fromApiResponseData(data) {
        let instance = new this(), i, l, note

        for (i = 0, l = data.length; i < l; i++) {
            note = Note.fromApiResponseData(data)

            instance.notes[note.getId()] = note
        }

        return instance
    }

    /**
     * @param {Note} note
     *
     * @return {NoteCollection}
     */
    add(note) {
        this.notes[note.getId()] = note

        return this
    }

    /**
     * @param {Note} note
     *
     * @return {NoteCollection}
     */
    remove(note) {
        delete this.notes[note.getId()]

        return this
    }

    /**
     * @return {Note[]}
     */
    all() {
        return Object.values(this.notes)
    }
}
