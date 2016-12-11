/**
 * Created by dongshuyu on 2016/12/8.
 */

import React, { Component } from 'react';
import {
    AppRegistry,
    StyleSheet,
    Text,
    View,
    Image,
    TextInput,
    ScrollView,
    ListView,
} from 'react-native';


//图片数组
var imgs = [require('./seimg/1.jpg'),require('./seimg/2.jpg'),require('./seimg/3.jpg'),require('./seimg/4.jpg'),require('./seimg/5.jpg')];

var Dimensions = require('Dimensions');
var screenWidth = Dimensions.get('window').width;
var TimerMixin = require('react-timer-mixin');

//组件申明必须大写
var ScrollViewDemo = React.createClass({
   //注册定时器
   mixins:[TimerMixin],
   getInitialState:function () {
       console.log("设置初始状态");
       //state每次修改的时候都会调用组件的render方法,重新渲染视图
       return {
            //设置初始页位置
            currentPage:0,
       }
   },

   componentWillMount:function () {
      console.log("组件将要被加载");
   },

   //常用网络请求等在这个方法里写 ,这个类加载完成之后执行的函数
   componentDidMount:function () {
      console.log("组件加载完成");
       this.startTimer();
   },

   //开启定时器的方法
   startTimer:function () {
       this.timer = this.setInterval(function () {
           if (this.state.currentPage+1>=imgs.length){
               //最后一张结束回到第一张
               this.setState({
                   currentPage:0,
               });
           }else{
               this.setState({
                   currentPage:this.state.currentPage+1,
               });
           }
           //获取当前的 scrollView
           var scrollView =this.refs.scroll;
           scrollView.scrollTo({
               x:this.state.currentPage*screenWidth,
               y:0,
               animated:true
           });
       },2000)
   },


   render: function () {
      console.log("渲染试图");
      return (
          //按页滚动 pagingEnabled
          //keyboardDismissMode={'on-drag'}
          <View>
             <ScrollView ref="scroll"
                 horizontal={true}
                 pagingEnabled={true}
                 showsHorizontalScrollIndicator={false}
                 //每一次滑动结束后调用的事件
                 onMomentumScrollEnd={this.onScrollEnd}
                 //开始拖拽
                 onScrollBeginDrag={this.startDrag}
                 //结束拖拽
                 onScrollEndDrag={this.endDrag}>
                {this.loadAllImage()}
             </ScrollView>
             <View style={styles.circleStyle}>
                {this.loadAllCircle()}
             </View>
          </View>
      )

   },

   //根据图片数组生成image标签
   loadAllImage :function () {
      var allImage = [];
      for(var i=0 ; i<imgs.length ; i++){
         allImage.push(
             <Image key={i} source={imgs[i]} style={{width:screenWidth,height:200}}/>
         )
      }
      return allImage;
   },

   loadAllCircle: function () {
      var allCircle = [];
      var color;
      for(var i=0 ; i<imgs.length ; i++){
         color = (i == this.state.currentPage?'green':'white');
         allCircle.push(
             <Text key={i} style={{color:color,fontSize:25}}>&bull;</Text>
         )
      }
      return allCircle;
   },

   //滑动结束事件,改变当前页数
   onScrollEnd: function (e) {
      //获取当前轮播图的偏移量
      var x = e.nativeEvent.contentOffset.x;
      //更新当前的页数
      this.setState({
         currentPage:Math.floor(x/screenWidth),
      });
   },

   startDrag:function () {
       //setInterval(); 返回的是一个ID
       this.clearInterval(this.timer);
   },

   endDrag:function () {
       this.startTimer();
   },

});

const styles = StyleSheet.create({
   circleStyle:{
      position:'absolute',
      bottom:0,
      flexDirection:'row',
      backgroundColor:'rgba(0,0,0,0.2)',
      width:screenWidth,
      alignItems:'center',
   },
});

module.exports = ScrollViewDemo;