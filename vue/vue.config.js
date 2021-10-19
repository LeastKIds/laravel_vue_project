module.exports = {
  devServer:{
    proxy:{
      '/api':{
        target:'http://3.36.124.105:8000',
        changeOrigin:true,
        pathRewrite:{
          '^/api':''
        }
      }
    }
  },
  transpileDependencies: [
    'vuetify'
  ]
}
