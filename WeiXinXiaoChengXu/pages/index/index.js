//index.js
//获取应用实例
var app = getApp()
Page({
  data: {
    motto: 'Hello World',
    userInfo: {},
    arr:["JK","JJ","李敏镐","全智贤"],
    arr1:[]
  },
  //事件处理函数
  bindViewTap: function(event) {
    console.log(event);
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  onLoad: function () {
    console.log('onLoad')
    var that = this
    wx.request({
      url: 'https://c.m.163.com/recommend/getSubDocPic?from=toutiao',
      data: {},
      method: 'GET', // OPTIONS, GET, HEAD, POST, PUT, DELETE, TRACE, CONNECT
      // header: {}, // 设置请求的 header
      success: function(res){
        // success
        console.log(res);
        that.setData({
          arr1:res.data.tid
        })
      },
      fail: function() {
        // fail
      },
      complete: function() {
        // complete
      }
    })
    //调用应用实例的方法获取全局数据
    app.getUserInfo(function(userInfo){
      //更新数据
      that.setData({
        userInfo:userInfo
      })
    })
    
  }
})
