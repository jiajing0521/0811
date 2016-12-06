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
    TextInput,
    TouchableOpacity,
    AlertIOS
} from 'react-native';

export default class XieCheng extends Component {
    render(){
        return(
            <View style={XieChengStyle.container}>
                <View style={XieChengStyle.header}>
                    <View style={[XieChengStyle.headerV1,XieChengStyle.center]}>
                        <TextInput style={[XieChengStyle.borderC,XieChengStyle.headerInput]} placeholder={"搜索:目的地/酒店/景点/航班号"} />
                    </View>
                    <View style={XieChengStyle.headerV2}>
                        <View>
                            <Image source={require("./img/wode.png")} style={{width:20,height:20,marginTop:8}} />
                        </View>
                        <View>
                            <Text style={{color: "rgb(22,141,241)"}}>我 的</Text>
                        </View>
                    </View>
                </View>
                <View style={XieChengStyle.slider}>
                    <Text>SLIDER</Text>
                </View>
                <View style={XieChengStyle.classify}>
                    <View style={XieChengStyle.classifyList}>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgPink,XieChengStyle.center]}>
                            <View>
                                <Text style={XieChengStyle.fontColorW}>酒店</Text>
                            </View>
                            <View>
                                <Image source={require("./img/jiudian.png")} style={{width:50,height:40,marginTop:8}}/>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgPink]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>海外</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>特价</Text>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgPink]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>团购</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>民宿/客栈</Text>
                            </View>
                        </View>
                    </View>
                    <View style={XieChengStyle.classifyList}>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgBlue,XieChengStyle.center]}>
                            <View>
                                <Text style={XieChengStyle.fontColorW}>机票</Text>
                            </View>
                            <View>
                                <Image source={require("./img/jipiao.png")} style={{width:50,height:40,marginTop:8}}/>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgBlue]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>火车票/抢票</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>特价机票</Text>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgBlue]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>汽车票/船票</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>专车/租车</Text>
                            </View>
                        </View>
                    </View>
                    <View style={XieChengStyle.classifyList}>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgGreen,XieChengStyle.center]}>
                            <View>
                                <Text style={XieChengStyle.fontColorW}>旅游</Text>
                            </View>
                            <View>
                                <Image source={require("./img/lvyou.png")} style={{width:50,height:40,marginTop:8}}/>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgGreen]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>目的地攻略</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>周边游</Text>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgGreen]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>邮轮</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>定制旅行</Text>
                            </View>
                        </View>
                    </View>
                    <View style={XieChengStyle.classifyList}>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgOrange]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>景点/玩乐</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>礼品卡</Text>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgOrange]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>美食</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>出境WIFI</Text>
                            </View>
                        </View>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgOrange]}>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderB,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>全球购/换汇</Text>
                            </View>
                            <View style={[XieChengStyle.innerView,XieChengStyle.borderL]}>
                                <Text style={XieChengStyle.fontColorW}>保险/签证</Text>
                            </View>
                        </View>
                    </View>
                </View>
                <View style={XieChengStyle.tabWrap}>
                    <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                        <Text>自由行</Text>
                    </View>
                    <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                        <Text>自由行</Text>
                    </View>
                    <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                        <Text>自由行</Text>
                    </View>
                    <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                        <Text>自由行</Text>
                    </View>
                </View>
            </View>
        )
    }
}

const XieChengStyle = StyleSheet.create({
    container:{
        flex:1,
        backgroundColor: "rgb(239,239,239)"
    },
    header:{
        flexDirection: "row",
        height: 50,
        borderBottomWidth: 1,
        borderBottomColor: "#ccc",
    },
    headerV1:{
        flex:8,
    },
    headerV2:{
        flex:1,
        alignItems: "center",
    },
    headerInput:{
        flex:1,
        margin: 10,
        backgroundColor: "white",
        borderRadius: 5,
        padding: 5,
        paddingLeft: 25,
    },
    slider:{
        marginTop: 70,
    },
    classify:{
        marginTop: 5,
        height: 380,
    },
    classifyList:{
        flex:1,
        margin:2,
        flexDirection: "row",
    },
    classifyListItem:{
        flex:1,
        // height: 80,
    },
    innerView:{
        flex:1,
        justifyContent:"center",
        alignItems:"center",
    },
    tabWrap:{
        marginTop:5,
        marginLeft: 2,
        marginRight: 2,
        flexWrap: "wrap",
        flexDirection: "row",
        justifyContent: "space-between",
    },
    tabItem:{
        height: 50,
        flex: 1,
        backgroundColor: "white",
    },
    bgPink:{
        backgroundColor: "rgb(250,82,102)",
    },
    bgBlue:{
        backgroundColor: "rgb(49,133,255)",
    },
    bgGreen:{
        backgroundColor: "rgb(64,187,0)",
    },
    bgOrange:{
        backgroundColor: "rgb(248,132,0)",
    },
    center:{
        justifyContent: "center",
        alignItems: "center",
    },
    borderC:{
        borderWidth: 1,
        borderColor: "#ccc",
    },
    borderAll:{
        borderWidth:1,
        borderColor:"rgb(239,239,239)",
    },
    borderB:{
        borderBottomWidth:2,
        borderColor:"rgb(239,239,239)",
    },
    borderL:{
        borderLeftWidth:2,
        borderColor:"rgb(239,239,239)",
    },
    fontColorW:{
        color: "white",
        fontWeight: "bold"
    }
});

module.exports = XieCheng;