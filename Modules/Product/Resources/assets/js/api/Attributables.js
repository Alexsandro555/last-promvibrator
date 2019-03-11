import axios from 'axios'

export const api = {
  delete({url, data}) {
    return new Promise((resolve, reject) => {
      axios.post(url+'/delete', data).then(response => response.data).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  }
}