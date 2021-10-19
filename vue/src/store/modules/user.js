import axios from 'axios';

export default{
    state : () => ({
       user : ''
    }),
 actions : {
     loginCheck() {
         return axios.get('http://3.36.124.105:8000/auth/user')
             .then(response => {
                 // console.log('login check : ' + response.status);
                 // console.log(response);
                 return response.data
             }).catch((err) => {
                 console.log('login check err');
                 return Promise.reject(err);
             });
     },
     login(_,payload) {
         console.log(payload);
         const data = {email : payload.email, password : payload.password};
         return axios.post('http://3.36.124.105:8000/login', data)
             .then(response => {
                 return response;
             }).catch(err => {
                 console.log('login error');
                 return Promise.reject(err);
             });
     },
     logout() {
         return axios.post('http://3.36.124.105:8000/logout')
             .then(response => {
                 return response;
             }).catch(err => {
                 console.log(err);
                 return Promise.reject(err);
             })
     }
 },
    mutations : {
        saveUser(state, user) {
            state.user = user;
        }
    }
}