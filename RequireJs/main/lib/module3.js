/**
 * Created by dllo on 16/12/13.
 */

//有依赖其他模块
define(["./module1","./jquery"],function (m1,$) {
    return {
        a: function () {
            $(document.body).html(m1.name)
        }
    }
});