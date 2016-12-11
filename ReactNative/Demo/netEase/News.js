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
    WebView,
} from 'react-native';

var News = React.createClass({
   render: function () {
       return (
           <NavigatorIOS
               style={{flex:1}}
               translucent={false}
               initialRoute={{
                   component:FirstView,
                   title:'新闻'
               }}
           />
       )
   }
});
//http://c.m.163.com/recommend/getSubDocPic?from=toutiao&offset=1&size=10

var ds = new ListView.DataSource({
    rowHasChanged: (r1, r2) => r1 != r2
});

var FirstView = React.createClass({
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
        fetch('http://c.m.163.com/recommend/getSubDocPic?from=toutiao')
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
            <TouchableOpacity onPress={()=>{this.push(rowData)}}>
                <View style={{borderBottomWidth:1,borderBottomColor:'black'}}>
                    <Image source={{uri:rowData.img}} style={{width:80,height:80}}/>
                    <Text>{rowData.title}</Text>
                </View>
            </TouchableOpacity>
        )
    },
    //跳转到详情页的方法
    push: function (rowData) {
        this.props.navigator.push({
            component: DetailView,
            title: rowData.title,
            //跳转时传值
            passProps:{data:rowData}
        })
    }
});

var DetailView = React.createClass({

    getInitialState: function () {
        return {
            htmlStr: ''
        }
    },

    componentDidMount: function () {
        fetch('http://c.m.163.com/nc/article/'+this.props.data.docid+'/full.html')
            .then((response) => response.json())
            .then((responseJson) => {
                //获取数据中的HTML字符串
                var htmlStr = responseJson[this.props.data.docid]['body'];
                //获取数据中的img
                var imgs = responseJson[this.props.data.docid]['img'];
                //替换HTML中的图片标签
                for(var i=0; i<imgs.length; i++){
                    htmlStr = htmlStr.replace(imgs[i]['ref'],"<img src='"+imgs[i]['src']+"' style='width: 100%'/>");
                }
                this.setState({
                    htmlStr:htmlStr
                })
            })
            .catch((error) => {});
    },

    render : function () {
        return (
            <View style={{flex:1}}>

                <WebView
                    source={{html:this.state.htmlStr}}
                />
            </View>
        )

    },
});

module.exports = News;