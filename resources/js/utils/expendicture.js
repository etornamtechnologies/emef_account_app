
import { createExpendictureType, getExpendictureType, updateExpendictureType, deleteExpendictureType
            ,createExpendicture, updateExpendicture, deleteExpendicture, getExpendicture } from '../api/expendicture'

export  function CreateNewExpendictureType(ExpendictureTypeData) {
    return new Promise((resolve, reject) => {
        createExpendictureType(ExpendictureTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function GetExpendictureTypes(query) {
    return new Promise((resolve, reject) => {
        getExpendictureType(query)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function UpdateExpendictureType(ExpendictureTypeData) {
    return new Promise((resolve, reject) => {
        updateExpendictureType(ExpendictureTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function DeleteExpendictureType(ExpendictureTypeData) {
    return new Promise((resolve, reject) => {
        deleteExpendictureType(ExpendictureTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function CreateExpendicture(ExpendictureTypeData) {
    return new Promise((resolve, reject) => {
        createExpendicture(ExpendictureTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function UpdateExpendicture(expendicture_data) {
    console.log(expendicture_data)
    return new Promise((resolve, reject) => {
        updateExpendicture(expendicture_data)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function DeleteExpendicture(ExpendictureTypeData) {
    return new Promise((resolve, reject) => {
        deleteExpendicture(ExpendictureTypeData)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}

export  function GetExpendicture(query) {
    return new Promise((resolve, reject) => {
        getExpendicture(query)
        .then(response => {
            const data = response || {}
            resolve(data)
        }).catch(error => {
            reject(error)
        })
    })
}