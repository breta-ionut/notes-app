export default class Credentials {
    /**
     * @type {string}
     *
     * @private
     */
    username

    /**
     * @type {string}
     *
     * @private
     */
    password

    /**
     * @returns {Credentials}
     */
    static fromViewData({username, password}) {
        const instance = new this()

        instance.username = username
        instance.password = password

        return instance
    }

    /**
     * @returns {Object}
     */
    toJSON() {
        return {username: this.username, password: this.password}
    }
}
