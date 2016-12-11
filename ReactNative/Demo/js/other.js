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
    TextInput
} from 'react-native';

class Other extends Component{
    render(){
        return(
            <View style={hotelStyle.hotelBG}>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>景点·玩乐</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>礼品卡</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>美食</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>出境WIFI</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel3}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>全球汇·换汇</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>保险·签证</Text>
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
        flex:1,
        height:100,
        flexDirection:'row',
        paddingLeft:5,
        paddingRight:5,
    },
    hotel1:{
        flex:1,
        backgroundColor:'#fc9720',
        borderBottomLeftRadius:8,
        borderTopLeftRadius:8,
        borderRightWidth:1,
        borderBottomWidth:2,
        borderColor:'#ccc',
    },
    hotel2:{
        flex:1,
        backgroundColor:'#fc9720',
        flexDirection:'column',
        borderRightWidth:1,
        borderColor:'#ccc',
    },
    hotel3:{
        flex:1,
        backgroundColor:'#fc9720',
        flexDirection:'column',
    },
    hotel4:{
        flex:1,
        backgroundColor:'#fc9720',
        borderBottomWidth:2,
        borderColor:'#ccc',

    },
    font:{
        color:'white',
    }
});

module.exports = Other;
