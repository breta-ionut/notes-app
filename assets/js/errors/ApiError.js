export default class ApiError extends Error {
    /**
     * @type {string}
     *
     * @private
     */
    title

    /**
     * @type {number}
     *
     * @private
     */
    status

    /**
     * @type {string|null}
     *
     * @private
     */
    detail

    /**
     * @type {Object}
     *
     * @private
     */
    original

    /**
     * @param {string} title
     * @param {number} status
     * @param {string|null} detail
     * @param {Object} original
     */
    constructor(title, status, detail, original) {
        super(title)

        this.title = title
        this.status = status
        this.detail = detail
        this.original = original
    }

    /**
     * @returns {ApiError}
     */
    static fromApiResponseData({title, status, detail}, original) {
        return new this(title, status, detail, original)
    }

    /**
     * @returns {string}
     */
    getTitle() {
        return this.title
    }

    /**
     * @returns {number}
     */
    getStatus() {
        return this.status
    }

    /**
     * @returns {string|null}
     */
    getDetail() {
        return this.detail
    }

    /**
     * @returns {Object}
     */
    getOriginal() {
        return this.original
    }
}
