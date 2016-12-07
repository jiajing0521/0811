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
    AlertIOS,
    ScrollView
} from 'react-native';

export default class XieCheng extends Component {
    render(){
        return(
            <View style={XieChengStyle.container}>
                <View style={XieChengStyle.header}>
                    <Image style={[XieChengStyle.search]} source={require("./img/sousuo.png")} />
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
                {/*<View style={XieChengStyle.slider}>*/}
                    <ScrollView style={{height:100}}>
                        <Image source={require("./img/129.jpg")}/>
                        <Image source={require("./img/130.jpg")}/>
                        <Image source={require("./img/131.jpg")}/>
                    </ScrollView>
                <View style={XieChengStyle.classify}>
                    <View style={XieChengStyle.classifyList}>
                        <View style={[XieChengStyle.classifyListItem,XieChengStyle.bgPink,XieChengStyle.center]}>
                            <View>
                                <Text style={XieChengStyle.fontColorW}>酒店</Text>
                            </View>
                            <View>
                                <Image source={require("./img/jiudian1.png")} style={{marginTop:8}}/>
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
                                <Image source={require("./img/jipiao1.png")} style={{marginTop:8}}/>
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
                                <Image source={require("./img/lvyou1.png")} style={{marginTop:8}}/>
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
                    <TabWrapItem title="自由行" imgSrc={require("./img/ziyouxing.png")} pinkColor={XieChengStyle.tabWrapFirst}/>
                    <TabWrapItem title="主题游" imgSrc={require("./img/ziyouxing.png")} />
                    <TabWrapItem title="一日游" imgSrc={require("./img/ziyouxing.png")} />
                    <TabWrapItem title="顶级游" imgSrc={require("./img/ziyouxing.png")} />
                </View>
                <TabWrapEx title1="酒店+景点" title2="亲子/游学" title3="外币兑换" title4="加盟合作" imgSrc1={require("./img/jiudianjingdian.png")} />
                <TabWrapEx title1="拼车旅行" title2="机场停车" title3="行李寄送" title4="更多服务" imgSrc1={require("./img/pinchelvxing.png")} />
                <TabWrapEx title1="拼车旅行" title2="机场停车" title3="行李寄送" title4="更多服务" imgSrc1={require("./img/pinchelvxing.png")} />
            </View>
        )
    }
}

class TabWrapItem extends Component{
    render(){
        return(
            <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                <View>
                    <Image source={this.props.imgSrc} />
                </View>
                <View style={this.props.pinkColor}>
                    <Text style={{fontSize:12,marginTop:5}}>{this.props.title}</Text>
                </View>
            </View>
        )
    }
}

class TabWrapEx extends Component{
    render(){
        return(
            <View style={XieChengStyle.tabWrap}>
                <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                    <View>
                        <Image source={this.props.imgSrc1} />
                    </View>
                    <View>
                        <Text style={{fontSize:12,marginTop:5}}>{this.props.title1}</Text>
                    </View>
                </View>
                <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                    <View>
                        <Image source={this.props.imgSrc1} />
                    </View>
                    <View>
                        <Text style={{fontSize:12,marginTop:5}}>{this.props.title2}</Text>
                    </View>
                </View>
                <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                    <View>
                        <Image source={this.props.imgSrc1} />
                    </View>
                    <View>
                        <Text style={{fontSize:12,marginTop:5}}>{this.props.title3}</Text>
                    </View>
                </View>
                <View style={[XieChengStyle.tabItem,XieChengStyle.borderAll,XieChengStyle.center]}>
                    <View>
                        <Image source={this.props.imgSrc1} />
                    </View>
                    <View>
                        <Text style={{fontSize:12,marginTop:5}}>{this.props.title4}</Text>
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
    search:{
        position: "absolute",
        left: 17,
        top:17,
        zIndex: 2,
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
        marginLeft: 2,
        marginRight: 2,
        flexWrap: "wrap",
        flexDirection: "row",
        justifyContent: "space-between",
    },
    tabWrapFirst:{
        backgroundColor: "pink",
    },
    tabItem:{
        height: 60,
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