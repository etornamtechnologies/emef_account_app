import axios from 'axios'
import { Message } from 'element-ui'
import store from '../store'
import { getApiToken } from '../utils/auth'

// create an axios instance
const service = axios.create({
  baseURL: process.env.VUE_APP_BASE_API, // api base_url
  timeout: 50000 // request timeout
})

// request interceptor
service.interceptors.request.use(
    config => {
        // Do something before request is sent
        if (store.getters.token) {
            config.headers['X-Token'] = getApiToken()
        }
        return config
    },
    error => {
        Promise.reject(error);
    }
)

// response interceptor
service.interceptors.response.use(
  response => {
    const res = response.data
    if (res.code !== 200) {
        Message({
            message: res.message,
            type: 'error',
            duration: 2 * 1000
        })
        if (res.code === 50008 || res.code === 50012 || res.code === 50014) {
            store.dispatch('FedLogOut').then(() => {
                location.reload()
            })
        }
        return Promise.reject('error')
    } else {
        console.log(response.config.method)
        if((response.config.method || "") != 'get') {
            Message({
                message: res.message || "",
                type: 'success',
                duration: 2 * 1000
            })
        }
        return response.data
    }
  },
  error => {
    Message({
      message: error.message,
      type: 'error',
      duration: 2 * 1000
    })
    return Promise.reject(error)
  }
)

export default service