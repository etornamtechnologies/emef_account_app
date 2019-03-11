
import { createRevenueType, getRevenueType, updateRevenueType, deleteRevenueType
            , createRevenue, deleteRevenue, updateRevenue, getRevenue} from '../api/revenue'

export  function CreateNewRevenueType(revenueTypeData) {
    return new Promise((resolve, reject) => {
        createRevenueType(revenueTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function GetRevenueTypes(query) {
    return new Promise((resolve, reject) => {
        getRevenueType(query)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function UpdateRevenueType(revenueTypeData) {
    return new Promise((resolve, reject) => {
        updateRevenueType(revenueTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function DeleteRevenueType(revenueTypeData) {
    return new Promise((resolve, reject) => {
        deleteRevenueType(revenueTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function CreateRevenue(revenueData) {
    return new Promise((resolve, reject) => {
        createRevenue(revenueData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function DeleteRevenue(revenueData) {
    return new Promise((resolve, reject) => {
        deleteRevenue(revenueData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function UpdateRevenue(revenueData) {
    return new Promise((resolve, reject) => {
        updateRevenue(revenueData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}


export  function GetRevenue(query) {
    return new Promise((resolve, reject) => {
        getRevenue(query)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}