import request from '../utils/request'

export function createExpendictureType(expendictureTypeData) {
    const data = expendictureTypeData;
    return request({
        url: '/api/expendicture-types',
        method: 'post',
        data
    })
}

export function updateExpendictureType(expendictureTypeData) {
    const data = expendictureTypeData;
    return request({
        url: `/api/expendicture-types/${data.id}`,
        method: 'put',
        data
    })
}

export function getExpendictureType(query) {
    const data = query;
    return request({
        url: '/api/expendicture-types',
        method: 'get',
        data
    })
}

export function deleteExpendictureType(expendictureData) {
    const data = expendictureData || {};
    return request({
        url: `/api/expendicture-types/${data.id}`,
        method: 'delete',
        data
    })
}


export function createExpendicture(expendictureData) {
    const data = expendictureData;
    return request({
        url: '/api/expendictures',
        method: 'post',
        data
    })
}

export function updateExpendicture(expendictureData) {
    const data = expendictureData;
    return request({
        url: `/api/expendictures/${data.id}`,
        method: 'put',
        data
    })
}


export function deleteExpendicture(expendictureData) {
    const data = expendictureData || {};
    return request({
        url: `/api/expendictures/${data.id}`,
        method: 'delete',
        data
    })
}

export function getExpendicture(query) {
    const data = query;
    return request({
        url: '/api/expendictures',
        method: 'get',
        data
    })
}
