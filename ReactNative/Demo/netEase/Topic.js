/**
 * Created by saunders on 2016/12/9.
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
    TabBarIOS,
} from 'react-native';

//http://c.m.163.com/newstopic/list/expert/5YWo5Zu9/0-10.html

var Topic = React.createClass({
    render: function () {
        return (
            <NavigatorIOS
                style={{flex:1}}
                initialRoute={{
                    component: TopicView,
                    title : '话题',
                }}
            />
        )
    }
});

var Dimensions = require("Dimensions");
var ScreenWidth = Dimensions.get('window').width;

var ds = new ListView.DataSource({
    rowHasChanged: (r1, r2) => r1 != r2
});

var TopicView = React.createClass({

    getInitialState: function () {
        return {
            dataSource : ds.cloneWithRows([])
        }
    },

    componentDidMount: function () {
        this.requestData();
    },

    //请求数据
    requestData: function () {
        fetch('http://c.m.163.com/newstopic/list/expert/5YWo5Zu9/0-10.html')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({
                    dataSource: ds.cloneWithRows(responseJson.tid)
                });
            })
            .catch((error) => {});
    },

    render: function () {
        return (
            <View>
                <ListView
                    dataSource={this.state.dataSource}
                    renderRow={this.renderRow}
                    enableEmptySections={true}
                />
            </View>
        )
    },

    renderRow: function (rowData,sectionID,rowID) {
        return (
            // 为了好传参()=>{this.push(rowData)}
            <TouchableOpacity>
                <View style={{borderBottomWidth:1,borderBottomColor:'black'}}>
                    <Image source={{uri:rowData.img}} style={{width:ScreenWidth,height:200}}/>
                    <Text>{rowData.title}</Text>
                </View>
            </TouchableOpacity>
        )
    },
});


module.exports = Topic;