import axios from 'axios'

export default {
    login({ commit }, credentials ) {
        return new Promise((resolve, reject) => {
            return axios.post('/login', credentials).then((response) => {
                return resolve(response.data.token)
            }).catch((error) => {
                return reject(error)
            })
        })
    },

    getUser({ commit }) {
        return new Promise((resolve, reject) => {
            return axios.get('/user').then((response) => {
                commit('setUser', response.data)
                return resolve(response.data.token)
            }).catch((error) => {
                return reject(error)
            })
        })
    }
}