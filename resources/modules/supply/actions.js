import axios from 'axios'

export default {
    getSupplies({ commit }, filters) {
        return new Promise((resolve, reject) => {
            return axios.post('/supplies-search', {
                filter: filters
            }).then((response) => {
                return resolve(response.data)
            }).catch((error) => {
                return reject(error)
            })
        })
    },

    getSupplyById({ commit }, supplyId) {
        return new Promise((resolve, reject) => {
            return axios.get(`/supplies/${supplyId}`).then((response) => {
                return resolve(response.data)
            }).catch((error) => {
                return reject(error)
            })
        })
    },
    create({ commit }, supply ) {
        return new Promise((resolve, reject) => {
            return axios.post('/supplies', supply).then((response) => {
                return resolve(response.data)
            }).catch((error) => {
                return reject(error)
            })
        })
    },

    update({ commit },  supply) {
        return new Promise((resolve, reject) => {
            return axios.put(`/supplies/${supply.id}`, supply).then((response) => {
                return resolve(response.data)
            }).catch((error) => {
                return reject(error)
            })
        })
    },

    delete({ commit }, supplyId) {
        return new Promise((resolve, reject) => {
            return axios.delete(`/supplies/${supplyId}`).then((response) => {
                return resolve(response.data)
            }).catch((error) => {
                return reject(error)
            })
        })
    },
}