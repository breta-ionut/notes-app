export default class Note {
    /**
     * @type {number}
     */
    #id

    /**
     * @type {string}
     */
    #name

    /**
     * @type {string}
     */
    #content

    /**
     * @returns {Note}
     */
    static fromViewData({name, content}) {
        let instance = new Note()

        instance.#name = name
        instance.#content = content

        return instance
    }

    /**
     * @returns {Note}
     */
    static fromApiResponseData({id, name, content}) {
        let instance = new Note()

        instance.#id = id
        instance.#name = name
        instance.#content = content

        return instance
    }

    /**
     * @returns {number}
     */
    getId() {
        return this.#id
    }

    /**
     * @returns {boolean}
     */
    isNew() {
        return !this.#id
    }

    /**
     * @returns {string}
     */
    getName() {
        return this.#name
    }

    /**
     * @returns {string}
     */
    getContent() {
        return this.#content
    }

    /**
     * @returns {Object}
     */
    toJSON() {
        return {name: this.#name, content: this.#content}
    }
}