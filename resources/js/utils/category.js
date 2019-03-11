import request from '../utils/request'

export function createCategory(category_data) {

    const data = {
        label: category_data.label || ''
    }
    return request({
        url: '/api/categories',
        method: 'post',
        data
    })
}

export function getCategories(params) {
    return request({
        url: '/api/categories',
        method: 'post',
        params
    })
}