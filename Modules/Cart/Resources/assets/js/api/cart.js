import axios from "axios/index"

export const cartApi = {
    url: '/cart',
    get() {
        return new Promise((resolve, reject) => {
            axios.get(this.url+'/widget').then(response => response.data).then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    patch(data) {
        return new Promise((resolve, reject) => {
            axios.patch(this.url, data).then(response => response.data).then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    setQty({id, qty}) {
        return new Promise((resolve, reject) => {
            axios.get(this.url + '/set-qty/' + id+'/'+qty)
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    },
    delete(rowId) {
        return new Promise((resolve, reject) => {
            axios.delete(this.url+'/'+rowId)
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    }
}