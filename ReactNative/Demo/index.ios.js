/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 * @flow
 */

import React, { Component } from 'react';
import {
  AppRegistry,
  StyleSheet,
  Text,
  View,
  Image,
  TextInput, 
  ScrollView
} from 'react-native';

export default class Demo extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Text style={styles.welcome}>
          这是我的第一个ReactNative
        </Text>
        <Text style={styles.instructions}>
          To get started, edit index.ios.js
        </Text>
        <Text style={styles.instructions}>
          Press Cmd+R to reload,{'\n'}
          Cmd+D or shake for dev menu
        </Text>
      </View>
    );
  }
}
console.log("JK");
const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F5FCFF',
  },
  welcome: {
    fontSize: 30,
    textAlign: 'center',
    margin: 10,
    color: "red"
  },
  instructions: {
    textAlign: 'center',
    color: '#333333',
    marginBottom: 5,
  },
});
//ES6的写法
//声明一个类继承Component
//reactNative默认:  flex布局  主轴是y轴
class Hello extends Component {
  render(){
    return (
        // view是预置好的控件
        <View style={helloStyle.container}>
          <View style={helloStyle.view1}></View>
          <View style={helloStyle.view2}></View>
          <View style={helloStyle.view3}></View>
          {/*注释*/}
          {/*<View style={helloStyle.view2}></View>*/}
          {/*<View style={helloStyle.view1}></View>*/}
        </View>
    )
  }
}

//创建样式表
const helloStyle = StyleSheet.create({
  container:{
    height: 300,
    backgroundColor: "#ccc",
      //设定主轴为x
    flexDirection: "row",
    //固定20
    marginTop: 20,
      //主轴方向
      justifyContent: "space-around",
      //排不下换行,默认不换行
      flexWrap:"wrap",
      // flex: 1,
      alignItems: "flex-end",
  },
  view1:{
    width: 100,
    height:100,
    backgroundColor: "red",
    flex:1,
  },
  view2:{
    width: 100,
    height:100,
    backgroundColor: "blue",
    flex:2,
    alignSelf: "center"
  },
  view3:{
    width: 100,
    height:100,
    backgroundColor: "green",
    flex:1,
  }
});

//获取宽高
var Dimensions = require("Dimensions");
console.log(Dimensions.get("window").width);
console.log(Dimensions.get("window").height);

//QQ模拟
var QQ = require("./QQ.js");

class QQModule extends Component{
  render(){
    return(
        <View style={QQModuleStyle.all}>
          <QQ />
        </View>
    )
  }
}
const QQModuleStyle = StyleSheet.create({
    all:{
        flexDirection: "row",
        marginTop: 20,
        flex:1,
    }
});

//携程模拟
var XieCheng = require("./XieCheng");
class XieChengModule extends Component{
    render(){
        return(
            <ScrollView style={XieChengModuleStyle.all}>
                <XieCheng />
            </ScrollView>
        )
    }

}

const XieChengModuleStyle = StyleSheet.create({
    all:{
        flex:1,
        marginTop: 20,
    }
})

class xiecheng extends Component{
  render(){
    return(
        <View style={xiechengStyle.container}>
          <QQ />
          <View style={[xiechengStyle.item,xiechengStyle.firstItem]}>
            <View>
              <Text>酒店</Text>
              {/*加载本地图片*/}
              {/*<Image source={require("./1.jpg")} />*/}
              {/*加载远程图片,里面是一个对象*/}
              <Image source={{uri:"https://gw.alicdn.com/tps/TB1exaOLVXXXXXeXFXXXXXXXXXX-183-129.png?imgtag=avatar"}} style={{width:50,height:50}} />
            </View>
          </View>
          <View style={xiechengStyle.item}>
            <View style={[xiechengStyle.innerView,xiechengStyle.borderB,xiechengStyle.borderL]}>
              <Text>海外酒店</Text>
            </View>
            <View style={[xiechengStyle.innerView,xiechengStyle.borderL]}>
              <Text>特价酒店</Text>
            </View>
          </View >
          <View style={xiechengStyle.item}>
            <View style={[xiechengStyle.innerView,xiechengStyle.borderB,xiechengStyle.borderL]}>
              <Text>团购</Text>
            </View>
            <View style={[xiechengStyle.innerView,xiechengStyle.borderL]}>
              <Text>民宿\客栈</Text>
            </View>
          </View>
          <View>
            <TextInput style={{width:100,height:20,borderWidth:1,borderColor:"green"}} placeholder={"可以多行文本"} multiline={true} secureTextEntry={true}/>
            <TextInput style={{width:100,height:20,borderWidth:1,borderColor:"green"}} placeholder={"安全文本输入"} secureTextEntry={true}/>
            <TextInput style={{width:100,height:20,borderWidth:1,borderColor:"green"}} placeholder={"数字键盘"} keyboardType={"numeric"} />
            <TextInput style={{width:100,height:20,borderWidth:1,borderColor:"green"}} placeholder={"带@键盘"} keyboardType={"email-address"} />
          </View>
        </View>
    )
  }
}

const xiechengStyle = StyleSheet.create({
    container:{
        height: 70,
        flex:1,
        flexDirection: "row",
        marginTop: 20,
    },
    item:{
        flex:1,
        backgroundColor: "pink",
        height: 80,
    },
    innerView:{
        flex:1,
        justifyContent:"center",
        alignItems:"center",
    },
    firstItem:{
        justifyContent:"center",
        alignItems:"center"
    },
    borderB:{
        borderBottomWidth:5,
        borderColor:"white",
    },
    borderL:{
        borderLeftWidth:5,
        borderColor:"white",
    },
    wrap1:{
      backgroundColor:"red",
    }
});

class IScrolledDown extends Component {
    render() {
        return(
            <ScrollView>
                <Text style={{fontSize:20}}>Scroll me plz</Text>
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Text style={{fontSize:20}}>If you like</Text>
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Text style={{fontSize:20}}>Scrolling down</Text>
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Text style={{fontSize:20}}>What's the best</Text>
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Text style={{fontSize:20}}>Framework around?</Text>
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Image source={require('./img/129.jpg')} />
                <Text style={{fontSize:30}}>React Native</Text>
            </ScrollView>
        );
    }
}
var ListViewDemo = require("./listViewDemo");

AppRegistry.registerComponent('Demo', () => ListViewDemo);

// AppRegistry.registerComponent('Demo', () => XieChengModule);
// AppRegistry.registerComponent('Demo', () => IScrolledDown);
