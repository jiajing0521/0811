/**
 * Created by dllo on 16/12/8.
 */
import React, { Component } from 'react';
import {
    AppRegistry,
    StyleSheet,
    Text,
    View,
    Image,
    TextInput,
    TouchableOpacity,
    ScrollView,
    AlterIOS,
    TabBarIOS
} from 'react-native';

var TabBarExample = React.createClass({
    statics: {
        title: '<TabBarIOS>',
        description: 'Tab-based navigation.',
    },
    displayName: 'TabBarExample',
    getInitialState: function() {
        return {
            selectedTab: 'redTab',
            notifCount: 0,
            presses: 0,
            selfCount:0
        };
    },
    _renderContent: function(color,pageText,num) {
    return (
        <View style={[styles.tabContent, {backgroundColor: color}]}>
            <Text style={styles.tabText}>{pageText}</Text>
            <Text style={styles.tabText}>{num} re-renders of the {pageText}</Text>
        </View>
    );
},
    render: function() {
        return (
            <TabBarIOS
                unselectedTintColor="black"
                tintColor="red"
                translucent="false"
                barTintColor="darkslateblue">
                <TabBarIOS.Item
                    title="按钮一"
                    icon={require("./img/a.png")}
                    selected={this.state.selectedTab === 'blueTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'blueTab',
                        });
                    }}>
                    {this._renderContent('#414A8C', 'Blue Tab')}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    systemIcon="history"
                    badge={this.state.notifCount > 0 ? this.state.notifCount : undefined}
                    selected={this.state.selectedTab === 'redTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'redTab',
                            notifCount: this.state.notifCount + 1,
                        });
                    }}>
                    {this._renderContent('#783E33', 'Red Tab', this.state.notifCount)}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    icon={require("./img/a.png")}
                    selectedIcon={require("./img/b.png")}
                    renderAsOriginal
                    title="按钮三"

                    selected={this.state.selectedTab === 'greenTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'greenTab',
                            presses: this.state.presses + 1
                        });
                    }}>
                    {this._renderContent('#21551C', 'Green Tab', this.state.presses)}
                </TabBarIOS.Item>
                <TabBarIOS.Item
                    icon={require("./img/e.png")}
                    selectedIcon={require("./img/f.png")}
                    title="按钮四"
                    selected={this.state.selectedTab === 'yellowTab'}
                    onPress={() => {
                        this.setState({
                            selectedTab: 'yellowTab',
                            selfCount: this.state.selfCount + 1
                        });
                    }}
                    badge={this.state.selfCount}

                >
                    {this._renderContent('grey', '自己的', this.state.selfCount)}

                </TabBarIOS.Item>
            </TabBarIOS>
        );
    },

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
module.exports = TabBarExample;