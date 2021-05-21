import Token from './Token.js'

export default class User {
    /**
     * @type {number}
     */
    #id

    /**
     * @type {string}
     */
    #username

    /**
     * @type {Token}
     */
    #currentToken

    /**
     * @returns {User}
     */
    static fromApiResponseData({id, username, currentToken}) {
        let instance = new User()

        instance.#id = id
        instance.#username = username
        instance.#currentToken = Token.fromApiResponseData(currentToken)

        return instance
    }

    /**
     * @returns {number}
     */
    getId() {
        return this.#id
    }

    /**
     * @returns {string}
     */
    getUsername() {
        return this.#username
    }

    /**
     * @returns {Token}
     */
    getCurrentToken() {
        return this.#currentToken
    }
}
