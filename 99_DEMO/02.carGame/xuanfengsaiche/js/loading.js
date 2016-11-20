/**
 * Created by dllo on 16/10/24.
 */
//函数封装,参数为传入图片的对象，函数
function loading(obj,progress,fun) {
    //计算有多少张图片
    var imgCount = 0;
    for (var prop in obj){
        imgCount++;
    }
    //2.1......表示当前加载完成的图片个数
    var count = 0;
    //3......imgsObj用来保存加载完成的图片，属性名时图片的名字，属性值是对应的img对象，获取Image对象通过imgsObj.bg1
    var imgsObj = {};

    //2......遍历obj中所有的属性，每一条属性都是一个图片的src，都可以生成一个Image对象
    for (var prop in obj){
        var img = new Image();
        img.src = obj[prop];
        //4（闭包）......因为onload函数不会立刻执行，在图片加载完成之后才会执行，
        // 所以在onload函数内部，只能取到for循环的最后一个值（prop），
        // 想要取到for循环每一次的prop值时，通过函数a可以保存下来
        // a（prop）在函数a的内部就可以取到正确的prop的值
        //c为当时的相应的prop
        img.onload = (function (c) {
            return function () {
                //2.2......每加载完一张图片，count+1，所以可以用count表示加载的进度
                count++;
                //图片加载的进度函数
                progress((count/imgCount).toFixed(2)*100 + "%");
                //3.1......c是通过闭包传进来的当前加载完成的那张图片的名字
                //this是当前加载完成的Image对象
                imgsObj[c] = this;
                //2.3......不管加载顺序，加载完一张就count加1，
                // 如果count为图片的总个数时证明所有的图片加载完成
                if (count == imgCount){
                    //图片加载完成
                    fun(imgsObj);
                }
            }
        })(prop);
    }
}