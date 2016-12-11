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
} from 'react-native';

//var data = require("./data.json");

var ds = new ListView.DataSource({
    //看行有没有变动,只有当数据改变时才刷新row,列表的每一行都是row
    rowHasChanged:(r1,r2) => r1!=r2
});

var ListViewDemo = React.createClass({
    //设置初始值
    getInitialState: function () {

      return {
          //传入数据必须是数组,将来遍历数据给每一行
          //dataSource:ds.cloneWithRows(data.tid), //本地
          dataSource:ds.cloneWithRows([]),
      }
    },

    componentDidMount: function () {
        fetch('http://c.m.163.com/recommend/getSubDocPic?from=toutiao')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({
                    dataSource: ds.cloneWithRows(responseJson.tid)
                });
            })
            .catch((error) => {
                console.error(error);
            });
    },

    render:function () {
        return(
            <ListView
                //ListView中必须写的两个属性,一个数据源,一个每一行的视图如何展示
                dataSource = {this.state.dataSource}
                renderRow = {this.renderRow}
            />
        )
    },

    renderRow:function (rowData,sectionID,rowID,highLightRow) {
        return (
            <View style={{flexDirection:'row',borderBottomColor:'#ccc',borderBottomWidth:1}}>
                <Image source={{uri:rowData.img}} style={{width:100,height:100}}/>
                <Text>{rowData.title}</Text>
            </View>
        )
    }
});

module.exports = ListViewDemo;