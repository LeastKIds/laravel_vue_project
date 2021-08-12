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
     }
 }
}