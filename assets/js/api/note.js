import axios from '../axios.js'
import Note from '../models/Note.js'
import NoteCollection from '../models/NoteCollection.js'

export default {
    /**
     * @param {Note} note
     *
     * @return {Promise<Note>}
     */
    async create(note) {
        let response = await axios.post('/note', note)

        return Note.fromApiResponseData(response.data)
    },

    /**
     * @param {Note} note
     *
     * @return {Promise<Note>}
     */
    async update(note) {
        let response = await axios.put('/note/' + note.getId(), note)

        return Note.fromApiResponseData(response.data)
    },

    /**
     * @param {Note} note
     */
    async delete(note) {
        await axios.delete('/note' + note.getId())
    },

    /**
     * @return {Promise<NoteCollection>}
     */
    async list() {
        let response = axios.get('/note')

        return NoteCollection.fromApiResponseData(response.data)
    },
}
