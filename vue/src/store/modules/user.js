import axios from 'axios';

export default{
 actions : {
     loginCheck() {
         return axios.get('/api/auth/user')
             .then(response => {
                 // console.log('login check : ' + response.status);
                 // console.log(response);
                 return response.data
             }).catch((err) => {
                 console.log('login check err');
                 return Promise.reject(err);
             });
     },
     login(payload) {
         console.log(payload);
         // return axios.post('/api/login', data)
         //     .then(response => {
         //         return response;
         //     }).catch(err => {
         //         console.log('login error');
         //         return Promise.reject(err);
         //     });
     }
 }
}