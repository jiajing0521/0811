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

class Play extends Component{
    render(){
        return(
            <View style={hotelStyle.hotelBG}>
                <View style={[hotelStyle.hotel1,hotelStyle.center]}>
                    <View style={hotelStyle.one}>
                        <Text style={hotelStyle.font}>旅游</Text>
                    </View>
                    <View style={hotelStyle.two}>
                        <Image source={require('../img/4.png')} style={{width:30,height:30}}/>
                    </View>
                </View>
                <View style={hotelStyle.hotel2}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>目的地攻略</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>周边游</Text>
                    </View>
                </View>
                <View style={hotelStyle.hotel3}>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>邮 轮</Text>
                    </View>
                    <View style={[hotelStyle.hotel4,hotelStyle.center]}>
                        <Text style={hotelStyle.font}>定制旅行</Text>
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
        paddingLeft:5,
        paddingRight:5,
        borderBottomWidth:2,
        borderTopWidth:2,
        borderColor:'#ccc',
    },
    hotel1:{
        flex:1,
        height:100,
        backgroundColor:'#44c522',
        borderBottomLeftRadius:8,
        borderTopLeftRadius:8,
        borderRightWidth:1,
        borderColor:'#ccc',
    },
    hotel2:{
        flex:1,
        backgroundColor:'#44c522',
        flexDirection:'column',
        borderRightWidth:1,
        borderColor:'#ccc',
    },
    hotel3:{
        flex:1,
        backgroundColor:'#44c522',
        flexDirection:'column',
    },
    hotel4:{
        flex:1,
        backgroundColor:'#44c522',
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

module.exports = Play;