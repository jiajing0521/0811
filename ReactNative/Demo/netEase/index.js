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

var News = require('./News');
var Live = require('./Live');
var Topic = require('./Topic');
var My = require('./My');

var NetEase = React.createClass({
    getInitialState:function () {
        return {
            //设置初始被选中的
            selectedItem: 'news'
        }
    },

    render: function () {
        return (
            <View style={{flex:1}}>
                <TabBarIOS>
                    {/*新闻*/}
                    <TabBarIOS.Item
                        icon={require('image!tabbar_icon_news_normal')}
                        title='新闻'
                        selected={this.state.selectedItem === 'news'}
                        onPress={
                            ()=>{
                                this.setState({
                                    selectedItem: 'news'
                                })
                            }
                        }
                    >
                        <News/>
                    </TabBarIOS.Item>
                    {/*直播*/}
                    <TabBarIOS.Item
                        icon={require('image!tabbar_icon_media_normal')}
                        title='直播'
                        selected={this.state.selectedItem === 'media'}
                        onPress={
                            ()=>{
                                this.setState({
                                    selectedItem: 'media'
                                })
                            }
                        }
                    >
                        <Live/>
                    </TabBarIOS.Item>
                    {/*话题*/}
                    <TabBarIOS.Item
                        icon={require('image!tabbar_icon_bar_normal')}
                        title='话题'
                        selected={this.state.selectedItem === 'bar'}
                        onPress={
                            ()=>{
                                this.setState({
                                    selectedItem: 'bar'
                                })
                            }
                        }
                    >
                        <Topic/>
                    </TabBarIOS.Item>
                    {/*我的*/}
                    <TabBarIOS.Item
                        icon={require('image!tabbar_icon_me_normal')}
                        title='我的'
                        selected={this.state.selectedItem === 'me'}
                        onPress={
                            ()=>{
                                this.setState({
                                    selectedItem: 'me'
                                })
                            }
                        }
                    >
                        <My/>
                    </TabBarIOS.Item>
                </TabBarIOS>
            </View>
        )
    },
});

module.exports = NetEase;