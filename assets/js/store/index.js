import {createStore} from 'vuex'

import note from './modules/note.js'
import user from './modules/user.js'

export default createStore({
    modules: {
        note,
        user,
    },

    state: () => ({
        /**
         * @type {boolean}
         */
        activeModal: false,
    }),

    mutations: {
        activateModal: state => state.activeModal = true,

        deactivateModal: state => state.activeModal = false,
    },
})
