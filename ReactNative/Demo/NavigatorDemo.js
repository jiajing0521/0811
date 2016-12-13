/**
 * Created by saunders on 2016/12/8.
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
    TouchableOpacity,
    NavigatorIOS,
} from 'react-native';

//用来显示主页内容的
var Home = React.createClass({
    render: function () {
        return (
            //导航条高度固定是64
            <View style={{marginTop:64}}>
                <Text>这是主页</Text>
                <TouchableOpacity onPress={this.pushNext}>
                    <Text>跳转第二页</Text>
                </TouchableOpacity>
            </View>
        )
    },

    pushNext: function () {
        this.props.navigator.push({
            component: NextPage,
            title:'详情',
            //从前一页传到下一页时使用它,下一页用时this.props.name
            passProps: {name:'lee'},
        })
    }
});

//第二页
var NextPage = React.createClass({
    render: function () {
        return (
            <View style={{marginTop:64}}>
                <Text>这是详情页</Text>
                <Text>{this.props.name}</Text>
            </View>
        )
    }
});

var NavigatorDemo = React.createClass({
    render: function () {
        return (
            <NavigatorIOS
                style={{flex:1}}
                translucent={true} //导航条是否半透明translucent
                initialRoute={{
                    component: Home,
                    title: '网易',
                }}
            />
        )
    }
});

module.exports = NavigatorDemo;