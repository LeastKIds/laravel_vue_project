import axios from 'axios';

export default {
    actions : {
        postSave(_,data) {
            console.log('data : ' + data);
            const headers = {
                'Content-Type' : 'multipart/form-data'
            };



            return axios.post('/api/post/store', data, {headers})
                .then(response => {
                    console.log(response.data);
                    return response.data;

                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);

            })
        },
        postIndex() {
            return axios.get('/api/post/index')
                .then(response => {
                    console.log(response.data);
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
            });
        }
    }
}