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
        postIndex(_,data) {
            const search = data.search;
            const page = data.page

            let url='';

            if(search !='') {
                if(page != '')
                    url = '/api/post/search/' + search + '/?page=' + page;
                else
                    url = '/api/post/search/' + search;
            } else {
                if(page != '')
                    url = '/api/post/index?page=' + page;
                else
                    url = '/api/post/index';
            }

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


            return axios.post(url, data, {headers})
                .then(response => {
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
                });
        },
        myPostIndex(_,data) {
            const search = data.search;
            const page = data.page

            let url='';

            if(search !='') {
                if(page != '')
                    url = '/api/post/mySearch/' + search + '/?page=' + page;
                else
                    url = '/api/post/mySearch/' + search;
            } else {
                if(page != '')
                    url = '/api/post/myIndex?page=' + page;
                else
                    url = '/api/post/myIndex';
            }

            return axios.get(url)
                .then(response => {
                    return response.data;
                }).catch(err => {
                    console.log(err);
                    return Promise.reject(err);
                });
        }


    },
}