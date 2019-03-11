import axios from "axios/index"

export const Api = {
  url: '/callback',
  get() {
    return new Promise((resolve) => {
      axios.get(this.url).then(response => response.data).then(response => {
        resolve(response)
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
  }
}