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
        postIndex(_,page) {
            const url = '/api/post/index?page=' + page;
            return axios.get(url)
                .then(response => {
                    console.log(response.data);
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
            });
        },
        postShow(_,id) {
            const url = '/api/post/show/' + id;

            return axios.get(url)
                .then(response => {
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
                })
        }
    },
    state : () => ({
        page : null,

    }),
    mutations : {
        savePage(state, page) {
            state.page = page;
        }
    }
}