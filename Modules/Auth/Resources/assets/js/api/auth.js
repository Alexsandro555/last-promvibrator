import axios from "axios/index"

export const api = {
  get(url) {
    return new Promise((resolve) => {
      axios.get(url).then(response => response.data).then(response => {
        resolve(response)
      })
    })
  },
  post(url, data) {
    return new Promise((resolve, reject) => {
      axios.post(url, data).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  }
}