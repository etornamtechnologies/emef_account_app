import request from '../utils/request'

export function createRevenueType(revenueTypeData) {
    const data = revenueTypeData;
    return request({
        url: '/api/revenue-types',
        method: 'post',
        data
    })
}

export function updateRevenueType(revenueTypeData) {
    const data = revenueTypeData;
    return request({
        url: `/api/revenue-types/${data.id}`,
        method: 'put',
        data
    })
}

export function getRevenueType(query) {
    const data = query;
    return request({
        url: '/api/revenue-types',
        method: 'get',
        data
    })
}

export function deleteRevenueType(revenueData) {
    const data = revenueData || {};
    return request({
        url: `/api/revenue-types/${data.id}`,
        method: 'delete',
        data
    })
}


export function createRevenue(revenueData) {
    const data = revenueData;
    return request({
        url: '/api/revenues',
        method: 'post',
        data
    })
}

export function deleteRevenue(revenueData) {
    const data = revenueData;
    return request({
        url: `/api/revenues/${revenueData.id}`,
        method: 'delete',
        data
    })
}

export function updateRevenue(revenueData) {
    const data = revenueData;
    return request({
        url: `/api/revenues/${revenueData.id}`,
        method: 'put',
        data
    })
}

export function getRevenue(query) {
    const data = query;
    return request({
        url: '/api/revenues',
        method: 'get',
        data
    })
}
