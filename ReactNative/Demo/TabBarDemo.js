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
    TabBarIOS,
} from 'react-native';


var TabBarDemo = React.createClass({
    statics: {
        title: '<TabBarIOS>',
        description: 'Tab-based navigation.',
    },
    displayName: 'TabBarExample',
    getInitialState: function() {
        return {
            selectedTab: 'redTab',
            notifCount: 1,
            num:0,
        };
    },
    _renderContent: function(color, pageText, num) {
        return (
            <View style={[styles.tabContent, {backgroundColor: color}]}>
                <Text style={styles.tabText}>{pageText}</Text>
                <Text style={styles.tabText}>{num} re-renders of the {pageText}</Text>
            </View>
        );
    },

    render: function () {
        return (
            <TabBarIOS
                unselectedTintColor="rgb(147,147,147)"
                tintColor="blue"
                barTintColor="white">
                <TabBarIOS.Item
                    systemIcon = 'bookmarks'
                    selected={this.state.selectedTab === 'blueTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'blueTab',
                            num:this.state.num+=1,
                        });
                    }}
                >
                    {this._renderContent('orange', 'orange Tab',this.state.num)}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    systemIcon = 'favorites'
                    selected={this.state.selectedTab === 'greenTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'greenTab',
                        });
                    }}
                >
                    {this._renderContent('green', 'green Tab')}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    systemIcon = 'downloads'
                    badge = {this.state.notifCount}
                    selected={this.state.selectedTab === 'brownTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'brownTab',
                            notifCount:this.state.notifCount+=1,
                        });
                    }}
                >
                    {this._renderContent('brown', 'brown Tab')}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    systemIcon = 'more'
                    selected={this.state.selectedTab === 'hotpinkTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'hotpinkTab',
                        });
                    }}
                >
                    {this._renderContent('hotpink', 'hotpink Tab')}
                </TabBarIOS.Item>
            </TabBarIOS>
        )
    }
});


var styles = StyleSheet.create({
    tabContent: {
        flex: 1,
        alignItems: 'center',
    },
    tabText: {
        color: 'white',
        margin: 50,
    },
});

module.exports = TabBarDemo;