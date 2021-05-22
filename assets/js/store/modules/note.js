import noteApi from '../../api/note.js'
import note from '../../api/note.js'
import Note from '../../models/Note.js'
import NoteCollection from '../../models/NoteCollection.js'

/**
 * @throws {Error}
 */
const ensureNotesAreLoaded = state => {
    if (!state.notes) {
        throw new Error('The notes are not loaded yet.')
    }
}

export default {
    namespaced: true,

    state: () => ({
        /**
         * @type {NoteCollection|null}
         */
        notes: null,
    }),

    getters: {
        /**
         * @return {boolean}
         */
        areLoaded: state => !!state.notes,

        /**
         * @return {Note[]}
         */
        all: state => {
            ensureNotesAreLoaded(state)

            return state.notes.all()
        },
    },

    mutations: {
        /**
         * @param {Object} state
         * @param {Note} note
         */
        add(state, note) {
            ensureNotesAreLoaded(state)

            state.notes.add(note)
        },

        /**
         * @param {Object} state
         * @param {Note} note
         */
        remove(state, note) {
            ensureNotesAreLoaded(state)

            state.notes.remove(note)
        },

        /**
         * @param {Object} state
         * @param {NoteCollection} notes
         */
        set(state, notes) {
            state.notes = notes
        },
    },

    actions: {
        /**
         * @param {Function} commit
         * @param {Note} note
         */
        async create({commit}, note) {
            commit('add', await noteApi.create(note))
        },

        /**
         * @param {Function} commit
         * @param {Note} note
         */
        async update({commit}, note) {
            commit('add', await noteApi.update(note))
        },

        /**
         * @param {Function} commit
         * @param {Note} note
         */
        async delete({commit}, note) {
            await noteApi.delete(note)

            commit('remove', note)
        },

        async load({commit}) {
            commit('set', await noteApi.list())
        },
    },
}
