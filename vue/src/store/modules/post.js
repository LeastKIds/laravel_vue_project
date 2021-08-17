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
        },
        postDelete(_,id) {
            const url = '/api/post/delete/' + id;
            return axios.delete(url)
                .then(response => {
                    return response;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
                })
        },
        postUpdate(_,data) {

            console.log('---------------------');
            console.log(data.get('postId'));
            console.log('---------------------');

            const url = '/api/post/edit/' + data.get('postId');

            const headers = {
                'Content-Type' : 'multipart/form-data'
            };

            // const test = {'test' : 'test'}

            return axios.post(url, data, {headers})
                .then(response => {
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
                });
        }

    },
    state : () => ({
        page : 1,
        savePage : 1,

    }),
    mutations : {
        savePage(state, page) {
            state.page = page;
        },
        saveSavePage(state, page) {
            state.savePage = page;
        }
    }
}