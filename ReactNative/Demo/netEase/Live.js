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

var Live = React.createClass({
    render: function () {
        return (
            <NavigatorIOS
                style={{flex:1}}
                translucent={false}
                initialRoute={{
                    component: LiveV,
                    title:'热门'
                }}
            />
        )
    }
});

// http://data.live.126.net/livechannel/previewlist.json
var ds = new ListView.DataSource({
    rowHasChanged: (r1, r2) => r1 != r2
});

var Dimensions = require("Dimensions");
var ScreenWidth = Dimensions.get('window').width;

var LiveV = React.createClass({
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
        fetch('http://data.live.126.net/livechannel/previewlist.json')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({
                    dataSource: ds.cloneWithRows(responseJson.live_review)
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
                <View>
                    <Image source={{uri:rowData.image}} style={{width:ScreenWidth,height:200}}/>
                    <Text style={styles.txt}>{rowData.roomName}</Text>
                    <Text>{rowData.userCount}参与</Text>
                </View>
            </TouchableOpacity>
        )
    },

});

var styles = StyleSheet.create({

    txt: {
        position:'absolute',
        color:'white',
        zIndex:2,
    }
});

module.exports = Live;