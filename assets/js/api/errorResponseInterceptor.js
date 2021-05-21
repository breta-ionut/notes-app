import errorDetails from './errorDetails.js'
import ApiAuthenticationRequiredError from '../errors/ApiAuthenticationRequiredError.js'
import ApiError from '../errors/ApiError.js'
import ApiValidationError from '../errors/ApiValidationError.js'

const ERROR_TITLE_UNKNOWN = 'Unknown error.'

export default error => {
    let data

    if (!error.response?.data?.type) {
        throw new ApiError(ERROR_TITLE_UNKNOWN, 500, null, error)
    }

    data = error.response.data

    switch (true) {
        case errorDetails.VALIDATION_ERRORS === data.detail:
            throw ApiValidationError.fromApiResponseData(data, error)

        case 401 === data.status && errorDetails.AUTHENTICATION_FAILED !== data.detail:
            throw ApiAuthenticationRequiredError.fromApiResponseData(data, error)

        default:
            throw ApiError.fromApiResponseData(data, error)
    }
}
