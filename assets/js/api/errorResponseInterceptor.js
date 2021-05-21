import errorTitles from './errorTitles.js'
import ApiAuthenticationRequiredError from '../errors/ApiAuthenticationRequiredError.js'
import ApiError from '../errors/ApiError.js'
import ApiValidationError from '../errors/ApiValidationError.js'

export default error => {
    let data

    if (!error.response?.data?.type) {
        throw new ApiError(errorTitles.UNKNOWN_ERROR, 500, null, error)
    }

    data = error.response.data

    switch (true) {
        case data.violations:
            throw ApiValidationError.fromApiResponseData(data, error)

        case 401 === data.status && errorTitles.AUTHENTICATION_FAILED !== data.title:
            throw ApiAuthenticationRequiredError.fromApiResponseData(data, error)

        default:
            throw ApiError.fromApiResponseData(data, error)
    }
}
