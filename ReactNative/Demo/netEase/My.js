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

var My = React.createClass({
    render: function () {
        return (
            <View style={{flex:1,backgroundColor:'blue'}}>
                <Text>这是主页</Text>
            </View>
        )
    }
});

module.exports = My;