/**
 * Created by dllo on 16/12/6.
 */
import React, { Component } from 'react';
import {
    AppRegistry,
    StyleSheet,
    Text,
    View,
    Image,
    TextInput,
    TouchableOpacity,
    AlertIOS
} from 'react-native';

export default class QQ extends Component {
    render(){
        return (
            <View style={[QQstyle.all0]}>
                <View style={[QQstyle.header,QQstyle.center]}>
                    <Text style={{fontSize:25}}>添加账号</Text>
                </View>
                <View style={QQstyle.content}>
                    <View style={[QQstyle.cimg,QQstyle.center]}>
                        <Image source={require("./qq.png")} style={{width:100,height:100}}/>
                    </View>
                    <View  style={QQstyle.cinputAll}>
                        <TextInput style={[QQstyle.cinput,QQstyle.borderB]} placeholder={"QQ号/手机号/邮箱"}/>
                        <TextInput style={QQstyle.cinput} placeholder={"密码"} keyboardType={"numeric"}/>
                    </View>
                    {/*点击需要:TouchableOpacity,onPressIn按下,onPressOut抬起,onLongPress长按*/}
                    <TouchableOpacity onPress={this.logClick}>
                        <View style={[QQstyle.clog,QQstyle.center]}>
                            <Text style={{fontSize:25,color:"white"}}>登录</Text>
                        </View>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
    logClick(){
        AlertIOS.alert("用户点击了登录");
    }
}
const QQstyle = StyleSheet.create({
    all0:{
        flex:1,
        backgroundColor: "rgb(231,232,238)",
    },
    header:{
        height: 50,
        backgroundColor: "#fff",
    },
    content:{
        // backgroundColor: "#ccc",
    },
    cimg:{
      height: 150,
    },
    cinputAll:{
        height:100,
    },
    cinput:{
        flex:1,
        backgroundColor: "white",
        // textIndent:1,
    },
    borderB:{
        borderWidth: 1,
        borderColor: "rgb(231,232,238)",
    },
    clog:{
        height:50,
        marginTop:15,
        marginLeft: 15,
        marginRight: 15,
        backgroundColor: "rgb(35,172,238)",
        borderRadius:5,
    },
    center:{
        justifyContent:"center",
        alignItems:"center",
    }
});

module.exports = QQ;