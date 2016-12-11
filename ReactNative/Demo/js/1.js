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

class Hotel extends Component{
    render(){
        return(
            <View style={hotelStyle.hotelBG}>
                <View style={[hotelStyle.hotel1,hotelStyle.center]}>
                    <View style={hotelStyle.one}>
                        <Text style={hotelStyle.font}>酒店</Text>
                    </View>
                    <View style={hotelStyle.two}>
                        <Image source={require('../img/2.png')} style={{width:30,height:30}}/>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>海外酒店</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>特价酒店</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel3}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>团购</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>民宿·客栈</Text>
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
        flexDirection:'row',
        marginTop:3,
        paddingLeft:5,
        paddingRight:5,
        borderBottomWidth:2,
        borderTopWidth:2,
        borderColor:'#ccc',
    },
    hotel1:{
        flex:1,
        height:100,
        backgroundColor:'#ff697a',
        borderBottomLeftRadius:8,
        borderTopLeftRadius:8,
        borderRightWidth:1,
        borderColor:'#ccc',
    },
    hotel2:{
        flex:1,
        backgroundColor:'#ff697a',
        flexDirection:'column',
        borderRightWidth:1,
        borderColor:'#ccc',
    },
    hotel3:{
        flex:1,
        backgroundColor:'#ff697a',
        flexDirection:'column',
    },
    hotel4:{
        flex:1,
        backgroundColor:'#ff697a',
        borderBottomWidth:1,
        borderColor:'#ccc',

    },
    font:{
        color:'white',
    },
    one:{
        flex:1,
        justifyContent:'flex-end',
        marginBottom:3,
    },
    two:{
        flex:1,
    }
});

module.exports = Hotel;