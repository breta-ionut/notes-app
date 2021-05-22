export default class Token {
    /**
     * @type {string}
     *
     * @private
     */
    token

    /**
     * @type {Date}
     *
     * @private
     */
    expiresAt

    /**
     * @returns {Token}
     */
    static fromApiResponseData({token, expiresAt}) {
        let instance = new this()

        instance.token = token
        instance.expiresAt = new Date(expiresAt)

        return instance
    }

    /**
     * @returns {string}
     */
    getToken() {
        return this.token
    }

    /**
     * @returns {Date}
     */
    getExpiresAt() {
        return this.expiresAt
    }
}
