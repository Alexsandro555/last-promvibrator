import axios from "axios/index"

export const api = {
  url: '/category',
  get(parentId) {
    return new Promise((resolve, reject) => {
      axios.get(`${this.url}/${parentId}`).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  post(parentId) {
    return new Promise((resolve) => {
      axios.post(this.url, { parentId }).then(response => response.data).then(response => {
        resolve(response)
      })
    })
  }
}