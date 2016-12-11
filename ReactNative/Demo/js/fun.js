/**
 * Created by dllo on 16/12/7.
 */

import React, { Component } from 'react';
import {
    AppRegistry,
    StyleSheet,
    Text,
    View,
    Image,
    TextInput
} from 'react-native';

class Fun extends Component{
    render(){
        return(
            <View style={hotelStyle.hotelBG}>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>自由行</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>酒店+景点</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>拼车旅行</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>主题游</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>亲自·游学</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>机场停车</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>一日游</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>外币兑换</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>行李寄送</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>顶级游</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>加盟合作</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Image source={require('../img/5.png')} style={{width:20,height:20}}/>
                        <Text style={hotelStyle.font}>更多服务</Text>
                    </View>
                </View>
            </View>
        )
    }
}

const hotelStyle = StyleSheet.create({
    center:{
        justifyContent:"center",
        alignItems:"center",
    },
    hotelBG:{
        flex:2,
        height:200,
        flexDirection:'row',
        marginTop:3,
        paddingLeft:5,
        paddingRight:5,


    },
    hotel1:{
        flex:1,
        backgroundColor:'white',
        borderBottomLeftRadius:8,
        borderTopLeftRadius:8,
        borderRightWidth:1,
        borderBottomWidth:2,
        borderColor:'#ccc',
    },
    hotel2:{
        flex:1,
        backgroundColor:'white',
        flexDirection:'column',
        borderColor:'#ccc',
        borderWidth:1,
        borderBottomLeftRadius:8,
        borderTopLeftRadius:8,
    },
    hotel3:{
        flex:1,
        backgroundColor:'white',
        flexDirection:'column',
    },
    hotel4:{
        flex:1,
        backgroundColor:'white',
        borderBottomWidth:2,
        borderColor:'#ccc',

    },
    font:{
        color:'black',
    }
});

module.exports = Fun;

