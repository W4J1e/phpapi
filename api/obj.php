<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>实时疫情图</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/w4j1e/blog@master/js/yqdt/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/w4j1e/blog@master/js/yqdt/world.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/w4j1e/blog@master/js/yqdt/china.js"></script>

    <style>
        body {
            height: 800px;
            overflow: hidden;
        }

        *:focus {
            outline: none;
        }

        #main {
            max-width: px;
            margin: auto;
        }

        .info {
            display: flex;
            justify-content: space-between;
            text-align: center;
            line-height: 0.5;
            border-bottom: 1px solid #ebebeb;

        }

        .info > div {
            flex-grow: 1;
            margin: 0 4px;
            border-radius: 3px;
        }

        .info > div > p:first-child {
            font-size: 12px;
        }

        .title {
            text-align: center;
        }

        .copyright {
            font-size: 10px;
            text-align: right;
            color: #909399;
        }

        .copyright a {
            text-decoration: none;
        }

        .copyright a:hover, a:active, a:visited, a:link, a:focus {
            color: #909399;
        }

        .map {
            position: relative;
            height: 500px;
        }

        #worldmap {
            height: 480px;
        }

        .copyright {
            position: relative;
            width: 100%;
        }

        .copyright, .map {
            top: -65px;
        }

        .hide {
            display: none;
        }

        #worldmap {
            width: 100%;
        }

        .button {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            height: 28px;
            padding: 0 15px;
            font-size: 14px;
            border-radius: 4px;
            transition: color .2s linear, background-color .2s linear, border .2s linear, box-shadow .2s linear;
            color: #515a6e;
            background-color: #fff;
            border-color: #dcdee2;
        }

        .btn-active {
            color: #fff;
            background-color: #2d8cf0;
            border-color: #2d8cf0;
        }

        .tab {
            margin-top: 5px;
            text-align: center;
        }
    </style>
    </head>

<body>
<div>
    <div class="title">2021新冠实时疫情图</div>
    <div class="tab">
        <button onclick="showcn(this)" id="btn-cn" class="button btn-active">中国</button>
        <button onclick="showworld(this)" id="btn-world" class="button">全球</button>
    </div>
    <div class="info" id="cninfo">
        <div>
            <p>现存确诊</p>
            <p style="color: rgb(247, 76, 49);">1815</p>
        </div>
        <div>
            <p>境外输入</p>
            <p style="color: rgb(247, 130, 7);">4489</p>
        </div>
        <div>
            <p>死亡</p>
            <p style="color: rgb(93, 112, 146);">4803</p>
        </div>
        <div>
            <p>治愈</p>
            <p style="color: rgb(40, 183, 163);">91841</p>
        </div>
    </div>

    <div class="info" id="worldinfo">

        <div>
            <p>现存确诊</p>
            <p style="color: rgb(247, 76, 49);">28453921</p>
        </div>
        <div>
            <p>累计确诊</p>
            <p style="color: rgb(247, 130, 7);">93656180</p>
        </div>

        <div>
            <p>累计死亡</p>
            <p style="color: rgb(93, 112, 146);">2003374</p>
        </div>
    </div>
</div>
<div id="cnmap" class="map"></div>
<div id="worldmap" class="map"></div>
<script type="text/javascript">
    var dom = document.getElementById("cnmap");
    var myChart = echarts.init(dom, null, {renderer: 'svg'});
    const cnoption = {
        bottom: '10px',
        tooltip: {
            show: true,
            trigger: 'item'
        },
        dataRange: {
            x: 'center',
            orient: 'horizontal',
            min: 0,
            max: 20000,
            text: ['高', '低'], // 文本，默认为数值文本
            splitNumber: 0,
            splitList: [
                {start: 1000, end: 99999},
                {start: 100, end: 1000},
                {start: 50, end: 100}, {start: 10, end: 50},
                {start: 1, end: 10},
                {start: 0, end: 0},
            ],
            inRange: {
                color: ['#fff', '#fff5c9', '#FDEBCF', '#F59E83', '#F59E83', '#CB2A2F', '#e6ac53', '#70161D']
            }
        },
        series: [
            {

                label: {

                    normal: {
                        fontFamily: 'Microsoft YaHei',
                        fontSize: 9,
                        show: true,

                    },
                    emphasis: {
                        show: false
                    }
                },
                name: '现存确诊',
                type: 'map',
                mapType: 'china',
                zoom: 1,
                itemStyle: {
                    normal: {
                        borderWidth: .5,//区域边框宽度
                        borderColor: '#B6B6B6',//区域边框颜色
                        areaColor: "#ffefd5",//区域颜色

                    },
                },
                data: JSON.parse('[{"name":"\u6cb3\u5317","value":645},{"name":"\u9999\u6e2f","value":607},{"name":"\u9ed1\u9f99\u6c5f","value":132},{"name":"\u53f0\u6e7e","value":95},{"name":"\u4e0a\u6d77","value":92},{"name":"\u5e7f\u4e1c","value":44},{"name":"\u8fbd\u5b81","value":36},{"name":"\u5317\u4eac","value":35},{"name":"\u798f\u5efa","value":23},{"name":"\u9655\u897f","value":23},{"name":"\u5929\u6d25","value":19},{"name":"\u5185\u8499\u53e4","value":15},{"name":"\u56db\u5ddd","value":11},{"name":"\u6d59\u6c5f","value":10},{"name":"\u6cb3\u5357","value":8},{"name":"\u4e91\u5357","value":5},{"name":"\u6c5f\u82cf","value":4},{"name":"\u5e7f\u897f","value":3},{"name":"\u5c71\u897f","value":3},{"name":"\u6e56\u5357","value":2},{"name":"\u5c71\u4e1c","value":2},{"name":"\u91cd\u5e86","value":1},{"name":"\u6e56\u5317","value":0},{"name":"\u5b89\u5fbd","value":0},{"name":"\u65b0\u7586","value":0},{"name":"\u6c5f\u897f","value":0},{"name":"\u7518\u8083","value":0},{"name":"\u6d77\u5357","value":0},{"name":"\u5409\u6797","value":0},{"name":"\u8d35\u5dde","value":0},{"name":"\u5b81\u590f","value":0},{"name":"\u6fb3\u95e8","value":0},{"name":"\u9752\u6d77","value":0},{"name":"\u897f\u85cf","value":0}]'),
            },
        ],
        animation: false,
    };
    myChart.setOption(cnoption, true);


    var worldmapdom = document.getElementById("worldmap");
    var worldChart = echarts.init(worldmapdom, null, {renderer: 'svg'});
    const worldoption = {
        bottom: '10px',
        tooltip: {
            show: true,
            trigger: 'item',
            formatter: function (val) {
                return val.data.provinceName + '<br>' + '现存确诊: ' + val.data.value
            }
        },
        dataRange: {
            x: 'center',
            orient: 'horizontal',
            min: 0,
            max: 9999999,
            text: ['高', '低'], // 文本，默认为数值文本
            splitNumber: 0,
            splitList: [
                {start: 100000, end: 999999999},
                {start: 10000, end: 999999},
                {start: 1000, end: 10000},
                {start: 99, end: 999},
                {start: 10, end: 99},
                {start: 0, end: 9},
            ],
            inRange: {
                color: ['#FAEBD2', '#D56355', '#BB3937','#cb2a2f', '#772526','#5e0a0b']
            }
        },
        series: [
            {

                label: {

                    normal: {
                        fontFamily: 'Microsoft YaHei',
                        fontSize: 9,
                        show: false
                    },
                    emphasis: {
                        show: false
                    }
                },
                name: '现存确诊',
                type: 'map',
                mapType: 'world',
                zoom: 0.8,
                itemStyle: {
                    normal: {label: {show: true, color: '#333'}, borderWidth: 0},
                },
                data: JSON.parse('[{"name":"United States","value":12756385,"provinceName":"\u7f8e\u56fd"},{"name":"United Kingdom","value":3228185,"provinceName":"\u82f1\u56fd"},{"name":"Spain","value":2048474,"provinceName":"\u897f\u73ed\u7259"},{"name":"Netherlands","value":876942,"provinceName":"\u8377\u5170"},{"name":"Brazil","value":824583,"provinceName":"\u5df4\u897f"},{"name":"France","value":824236,"provinceName":"\u6cd5\u56fd"},{"name":"Belgium","value":633353,"provinceName":"\u6bd4\u5229\u65f6"},{"name":"Italy","value":558068,"provinceName":"\u610f\u5927\u5229"},{"name":"Russia","value":546356,"provinceName":"\u4fc4\u7f57\u65af"},{"name":"Sweden","value":503627,"provinceName":"\u745e\u5178"},{"name":"Serbia","value":371515,"provinceName":"\u585e\u5c14\u7ef4\u4e9a"},{"name":"Germany","value":336690,"provinceName":"\u5fb7\u56fd"},{"name":"Ukraine","value":279030,"provinceName":"\u4e4c\u514b\u5170"},{"name":"Mexico","value":264832,"provinceName":"\u58a8\u897f\u54e5"},{"name":"Poland","value":224826,"provinceName":"\u6ce2\u5170"},{"name":"India","value":213027,"provinceName":"\u5370\u5ea6"},{"name":"South Africa","value":212529,"provinceName":"\u5357\u975e"},{"name":"Argentina","value":175855,"provinceName":"\u963f\u6839\u5ef7"},{"name":"Switzerland","value":169658,"provinceName":"\u745e\u58eb"},{"name":"Iran (Islamic Republic of)","value":154663,"provinceName":"\u4f0a\u6717"},{"name":"Czechia","value":143007,"provinceName":"\u6377\u514b"},{"name":"Greece","value":140423,"provinceName":"\u5e0c\u814a"},{"name":"Slovenia","value":140215,"provinceName":"\u65af\u6d1b\u6587\u5c3c\u4e9a"},{"name":"Ireland","value":138590,"provinceName":"\u7231\u5c14\u5170"},{"name":"Indonesia","value":138238,"provinceName":"\u5370\u5ea6\u5c3c\u897f\u4e9a"},{"name":"Portugal","value":125861,"provinceName":"\u8461\u8404\u7259"},{"name":"Colombia","value":123854,"provinceName":"\u54e5\u4f26\u6bd4\u4e9a"},{"name":"Hungary","value":112951,"provinceName":"\u5308\u7259\u5229"},{"name":"Turkey","value":103404,"provinceName":"\u571f\u8033\u5176"},{"name":"Lebanon","value":89478,"provinceName":"\u9ece\u5df4\u5ae9"},{"name":"Kazakhstan","value":87669,"provinceName":"\u54c8\u8428\u514b\u65af\u5766"},{"name":"Puerto Rico","value":83137,"provinceName":"\u6ce2\u591a\u9ece\u5404"},{"name":"Israel","value":78169,"provinceName":"\u4ee5\u8272\u5217"},{"name":"Canada","value":73067,"provinceName":"\u52a0\u62ff\u5927"},{"name":"Honduras","value":68665,"provinceName":"\u6d2a\u90fd\u62c9\u65af"},{"name":"Japan","value":66432,"provinceName":"\u65e5\u672c"},{"name":"Lithuania","value":62689,"provinceName":"\u7acb\u9676\u5b9b"},{"name":"Bulgaria","value":58913,"provinceName":"\u4fdd\u52a0\u5229\u4e9a"},{"name":"Panama","value":55932,"provinceName":"\u5df4\u62ff\u9a6c"},{"name":"Slovakia","value":54022,"provinceName":"\u65af\u6d1b\u4f10\u514b"},{"name":"Romania","value":52499,"provinceName":"\u7f57\u9a6c\u5c3c\u4e9a"},{"name":"Bangladesh","value":47469,"provinceName":"\u5b5f\u52a0\u62c9\u56fd"},{"name":"Dominican Republic","value":44842,"provinceName":"\u591a\u7c73\u5c3c\u52a0"},{"name":"Tunisia","value":40807,"provinceName":"\u7a81\u5c3c\u65af"},{"name":"Costa Rica","value":40268,"provinceName":"\u54e5\u65af\u8fbe\u9ece\u52a0"},{"name":"Peru","value":39297,"provinceName":"\u79d8\u9c81"},{"name":"Malaysia","value":35253,"provinceName":"\u9a6c\u6765\u897f\u4e9a"},{"name":"Pakistan","value":34169,"provinceName":"\u5df4\u57fa\u65af\u5766"},{"name":"occupied Palestinian territory","value":32297,"provinceName":"\u5df4\u52d2\u65af\u5766"},{"name":"Algeria","value":30313,"provinceName":"\u963f\u5c14\u53ca\u5229\u4e9a"},{"name":"Bolivia","value":29750,"provinceName":"\u73bb\u5229\u7ef4\u4e9a"},{"name":"Denmark","value":29245,"provinceName":"\u4e39\u9ea6"},{"name":"Iraq","value":28905,"provinceName":"\u4f0a\u62c9\u514b"},{"name":"Bosnia and Herzegovina","value":27950,"provinceName":"\u6ce2\u9ed1"},{"name":"Philippines","value":27033,"provinceName":"\u83f2\u5f8b\u5bbe"},{"name":"United Arab Emirates","value":26655,"provinceName":"\u963f\u8054\u914b"},{"name":"Chile","value":26439,"provinceName":"\u667a\u5229"},{"name":"Cyprus","value":26142,"provinceName":"\u585e\u6d66\u8def\u65af"},{"name":"Albania","value":25487,"provinceName":"\u963f\u5c14\u5df4\u5c3c\u4e9a"},{"name":"Uganda","value":24743,"provinceName":"\u4e4c\u5e72\u8fbe"},{"name":"Egypt","value":24248,"provinceName":"\u57c3\u53ca"},{"name":"Paraguay","value":22191,"provinceName":"\u5df4\u62c9\u572d"},{"name":"Libya","value":21298,"provinceName":"\u5229\u6bd4\u4e9a"},{"name":"Nigeria","value":20243,"provinceName":"\u5c3c\u65e5\u5229\u4e9a"},{"name":"Morocco","value":19202,"provinceName":"\u6469\u6d1b\u54e5"},{"name":"Austria","value":18587,"provinceName":"\u5965\u5730\u5229"},{"name":"Norway","value":18561,"provinceName":"\u632a\u5a01"},{"name":"Cura\u00e7ao","value":18354,"provinceName":"\u5e93\u62c9\u7d22\u5c9b"},{"name":"Ecuador","value":18175,"provinceName":"\u5384\u74dc\u591a\u5c14"},{"name":"North Macedonia","value":16231,"provinceName":"\u5317\u9a6c\u5176\u987f"},{"name":"Belarus","value":15540,"provinceName":"\u767d\u4fc4\u7f57\u65af"},{"name":"Kenya","value":14938,"provinceName":"\u80af\u5c3c\u4e9a"},{"name":"Georgia","value":14537,"provinceName":"\u683c\u9c81\u5409\u4e9a"},{"name":"French Guiana","value":14452,"provinceName":"\u6cd5\u5c5e\u572d\u4e9a\u90a3"},{"name":"Jordan","value":14405,"provinceName":"\u7ea6\u65e6"},{"name":"Myanmar","value":13842,"provinceName":"\u7f05\u7538"},{"name":"Ethiopia","value":13165,"provinceName":"\u57c3\u585e\u4fc4\u6bd4\u4e9a"},{"name":"Korea","value":13030,"provinceName":"\u97e9\u56fd"},{"name":"French Polynesia","value":12297,"provinceName":"\u6cd5\u5c5e\u6ce2\u5229\u5c3c\u897f\u4e9a"},{"name":"Latvia","value":11793,"provinceName":"\u62c9\u8131\u7ef4\u4e9a"},{"name":"Estonia","value":10227,"provinceName":"\u7231\u6c99\u5c3c\u4e9a"},{"name":"Zimbabwe","value":10018,"provinceName":"\u6d25\u5df4\u5e03\u97e6"},{"name":"Finland","value":9977,"provinceName":"\u82ac\u5170"},{"name":"Azerbaijan","value":9950,"provinceName":"\u963f\u585e\u62dc\u7586"},{"name":"The Republic of Zambia","value":9782,"provinceName":"\u8d5e\u6bd4\u4e9a\u5171\u548c\u56fd"},{"name":"Montenegro","value":9689,"provinceName":"\u9ed1\u5c71"},{"name":"R\u00e9union","value":9364,"provinceName":"\u7559\u5c3c\u65fa"},{"name":"Armenia","value":9149,"provinceName":"\u4e9a\u7f8e\u5c3c\u4e9a"},{"name":"Swaziland","value":9056,"provinceName":"\u65af\u5a01\u58eb\u5170"},{"name":"Sudan","value":8914,"provinceName":"\u82cf\u4e39"},{"name":"Guatemala","value":8703,"provinceName":"\u5371\u5730\u9a6c\u62c9"},{"name":"Guadeloupe","value":8678,"provinceName":"\u74dc\u5fb7\u7f57\u666e\u5c9b"},{"name":"Uruguay","value":8232,"provinceName":"\u4e4c\u62c9\u572d"},{"name":"Sri Lanka","value":7080,"provinceName":"\u65af\u91cc\u5170\u5361"},{"name":"Republic of Moldova","value":7060,"provinceName":"\u6469\u5c14\u591a\u74e6"},{"name":"Mayotte","value":6553,"provinceName":"\u9a6c\u7ea6\u7279"},{"name":"Afghanistan","value":6209,"provinceName":"\u963f\u5bcc\u6c57"},{"name":"Martinique","value":6184,"provinceName":"\u9a6c\u63d0\u5c3c\u514b"},{"name":"Oman","value":6162,"provinceName":"\u963f\u66fc"},{"name":"Mozambique","value":5706,"provinceName":"\u83ab\u6851\u6bd4\u514b"},{"name":"Syrian\u00a0ArabRepublic","value":5692,"provinceName":"\u53d9\u5229\u4e9a"},{"name":"Kuwait","value":5688,"provinceName":"\u79d1\u5a01\u7279"},{"name":"Venezuela","value":5326,"provinceName":"\u59d4\u5185\u745e\u62c9"},{"name":"Dem. Rep. Congo","value":5153,"provinceName":"\u521a\u679c\uff08\u91d1\uff09"},{"name":"The Republic of El Salvador","value":4888,"provinceName":"\u8428\u5c14\u74e6\u591a"},{"name":"Croatia","value":4653,"provinceName":"\u514b\u7f57\u5730\u4e9a"},{"name":"Lesotho","value":4646,"provinceName":"\u83b1\u7d22\u6258"},{"name":"Namibia","value":4357,"provinceName":"\u7eb3\u7c73\u6bd4\u4e9a"},{"name":"Malawi","value":4306,"provinceName":"\u9a6c\u62c9\u7ef4"},{"name":"Nepal","value":4301,"provinceName":"\u5c3c\u6cca\u5c14"},{"name":"Cuba","value":3911,"provinceName":"\u53e4\u5df4"},{"name":"Rwanda","value":3209,"provinceName":"\u5362\u65fa\u8fbe"},{"name":"Qatar","value":3204,"provinceName":"\u5361\u5854\u5c14"},{"name":"Bahrain","value":3127,"provinceName":"\u5df4\u6797"},{"name":"Thailand","value":3093,"provinceName":"\u6cf0\u56fd"},{"name":"Botswana","value":3076,"provinceName":"\u535a\u8328\u74e6\u7eb3"},{"name":"Central African Republic","value":2986,"provinceName":"\u4e2d\u975e\u5171\u548c\u56fd"},{"name":"Senegal","value":2982,"provinceName":"\u585e\u5185\u52a0\u5c14"},{"name":"Burkina Faso","value":2840,"provinceName":"\u5e03\u57fa\u7eb3\u6cd5\u7d22"},{"name":"Kyrgyzstan","value":2761,"provinceName":"\u5409\u5c14\u5409\u65af\u65af\u5766"},{"name":"Malta","value":2643,"provinceName":"\u9a6c\u8033\u4ed6"},{"name":"Luxembourg","value":2492,"provinceName":"\u5362\u68ee\u5821"},{"name":"Angola","value":2180,"provinceName":"\u5b89\u54e5\u62c9"},{"name":"Saudi Arabia","value":2117,"provinceName":"\u6c99\u7279\u963f\u62c9\u4f2f"},{"name":"Cote d Ivoire","value":2084,"provinceName":"\u79d1\u7279\u8fea\u74e6"},{"name":"Jamaica","value":2080,"provinceName":"\u7259\u4e70\u52a0"},{"name":"Mali","value":2040,"provinceName":"\u9a6c\u91cc"},{"name":"Cameroon","value":1993,"provinceName":"\u5580\u9ea6\u9686"},{"name":"Gibraltar","value":1964,"provinceName":"\u76f4\u5e03\u7f57\u9640"},{"name":"China","value":1815,"provinceName":"\u4e2d\u56fd"},{"name":"Congo","value":1749,"provinceName":"\u521a\u679c\uff08\u5e03\uff09"},{"name":"Nicaragua","value":1705,"provinceName":"\u5c3c\u52a0\u62c9\u74dc"},{"name":"The Republic of Haiti","value":1659,"provinceName":"\u6d77\u5730"},{"name":"Bahamas","value":1607,"provinceName":"\u5df4\u54c8\u9a6c"},{"name":"Niger","value":1414,"provinceName":"\u5c3c\u65e5\u5c14"},{"name":"Ghana","value":1404,"provinceName":"\u52a0\u7eb3"},{"name":"Mauritania","value":1275,"provinceName":"\u6bdb\u91cc\u5854\u5c3c\u4e9a"},{"name":"Andorra","value":1165,"provinceName":"\u5b89\u9053\u5c14"},{"name":"The Republic of Yemen","value":1151,"provinceName":"\u4e5f\u95e8\u5171\u548c\u56fd"},{"name":"The Republic of Burundi","value":1144,"provinceName":"\u5e03\u9686\u8fea\u5171\u548c\u56fd"},{"name":"Saint Martin","value":1034,"provinceName":"\u5723\u9a6c\u4e01\u5c9b"},{"name":"Eritrea","value":996,"provinceName":"\u5384\u7acb\u7279\u91cc\u4e9a"},{"name":"Somalia","value":975,"provinceName":"\u7d22\u9a6c\u91cc"},{"name":"Guinea","value":931,"provinceName":"\u51e0\u5185\u4e9a"},{"name":"Uzbekstan","value":891,"provinceName":"\u4e4c\u5179\u522b\u514b\u65af\u5766"},{"name":"Maldives","value":877,"provinceName":"\u9a6c\u5c14\u4ee3\u592b"},{"name":"Sierra Leone","value":834,"provinceName":"\u585e\u62c9\u5229\u6602"},{"name":"Tajikistan","value":634,"provinceName":"\u5854\u5409\u514b\u65af\u5766"},{"name":"Chad","value":630,"provinceName":"\u4e4d\u5f97"},{"name":"Suriname","value":618,"provinceName":"\u82cf\u91cc\u5357"},{"name":"Guyana","value":578,"provinceName":"\u572d\u4e9a\u90a3"},{"name":"Mongolia","value":569,"provinceName":"\u8499\u53e4"},{"name":"Cabo Verde","value":560,"provinceName":"\u4f5b\u5f97\u89d2"},{"name":"Aruba","value":541,"provinceName":"\u963f\u9c81\u5df4"},{"name":"Belize","value":535,"provinceName":"\u4f2f\u5229\u5179"},{"name":"Barbados","value":535,"provinceName":"\u5df4\u5df4\u591a\u65af"},{"name":"South Sudan","value":476,"provinceName":"\u5357\u82cf\u4e39"},{"name":"Guam","value":432,"provinceName":"\u5173\u5c9b"},{"name":"New Zealand","value":411,"provinceName":"\u65b0\u897f\u5170"},{"name":"Jersey","value":395,"provinceName":"\u6cfd\u897f\u5c9b"},{"name":"Australia","value":390,"provinceName":"\u6fb3\u5927\u5229\u4e9a"},{"name":"Togo","value":380,"provinceName":"\u591a\u54e5"},{"name":"Union des Comores","value":355,"provinceName":"\u79d1\u6469\u7f57"},{"name":"Saint Vincent and the Grenadines","value":340,"provinceName":"\u5723\u6587\u68ee\u7279\u548c\u683c\u6797\u7eb3\u4e01\u65af"},{"name":"Tanzania","value":321,"provinceName":"\u5766\u6851\u5c3c\u4e9a"},{"name":"Bhutan","value":300,"provinceName":"\u4e0d\u4e39"},{"name":"Trinidad & Tobago","value":293,"provinceName":"\u7279\u7acb\u5c3c\u8fbe\u548c\u591a\u5df4\u54e5"},{"name":"Madagascar","value":287,"provinceName":"\u9a6c\u8fbe\u52a0\u65af\u52a0"},{"name":"San Marino","value":285,"provinceName":"\u5723\u9a6c\u529b\u8bfa"},{"name":"Seychelles","value":279,"provinceName":"\u585e\u820c\u5c14"},{"name":"Singapore","value":278,"provinceName":"\u65b0\u52a0\u5761"},{"name":"Gabon","value":255,"provinceName":"\u52a0\u84ec"},{"name":"Monaco","value":237,"provinceName":"\u6469\u7eb3\u54e5"},{"name":"Papua New Guinea","value":237,"provinceName":"\u5df4\u5e03\u4e9a\u65b0\u51e0\u5185\u4e9a"},{"name":"Iceland","value":229,"provinceName":"\u51b0\u5c9b"},{"name":"United States Virgin Islands","value":227,"provinceName":"\u7f8e\u5c5e\u7ef4\u5c14\u4eac\u7fa4\u5c9b"},{"name":"Saint Barthelemy","value":224,"provinceName":"\u5723\u5df4\u6cf0\u52d2\u7c73\u5c9b"},{"name":"Liechtenstein","value":194,"provinceName":"\u5217\u652f\u6566\u58eb\u767b"},{"name":"Saint Lucia","value":187,"provinceName":"\u5723\u5362\u897f\u4e9a"},{"name":"Turks & Caicos\u00a0Islands","value":177,"provinceName":"\u7279\u514b\u65af\u548c\u51ef\u79d1\u65af\u7fa4\u5c9b"},{"name":"Bonaire, Sint Eustatius and Saba","value":174,"provinceName":"\u8377\u5170\u52a0\u52d2\u6bd4\u5730\u533a"},{"name":"The Republic of Djibouti","value":154,"provinceName":"\u5409\u5e03\u63d0"},{"name":"International conveyance (Diamond Princess)","value":154,"provinceName":"\u94bb\u77f3\u516c\u4e3b\u53f7\u90ae\u8f6e"},{"name":"Bermuda","value":130,"provinceName":"\u767e\u6155\u5927"},{"name":"Northern Mariana Islands (Commonwealth of the)","value":126,"provinceName":"\u5317\u9a6c\u91cc\u4e9a\u7eb3\u7fa4\u5c9b\u8054\u90a6"},{"name":"Sint Maarten","value":124,"provinceName":"\u8377\u5c5e\u5723\u9a6c\u4e01"},{"name":"Benin","value":122,"provinceName":"\u8d1d\u5b81"},{"name":"Vietnam","value":121,"provinceName":"\u8d8a\u5357"},{"name":"S\u00e3o Tom\u00e9 and Pr\u00edncipe","value":112,"provinceName":"\u5723\u591a\u7f8e\u548c\u666e\u6797\u897f\u6bd4"},{"name":"Liberia","value":97,"provinceName":"\u5229\u6bd4\u91cc\u4e9a"},{"name":"Gambia","value":77,"provinceName":"\u5188\u6bd4\u4e9a"},{"name":"Eq.Guinea","value":76,"provinceName":"\u8d64\u9053\u51e0\u5185\u4e9a"},{"name":"Guinea-Bissau","value":65,"provinceName":"\u51e0\u5185\u4e9a\u6bd4\u7ecd"},{"name":"Faroe Islands","value":62,"provinceName":"\u6cd5\u7f57\u7fa4\u5c9b"},{"name":"Cayman Islands","value":58,"provinceName":"\u5f00\u66fc\u7fa4\u5c9b"},{"name":"Grenada","value":55,"provinceName":"\u683c\u6797\u90a3\u8fbe"},{"name":"Cambodia","value":45,"provinceName":"\u67ec\u57d4\u5be8"},{"name":"Isle of Man","value":44,"provinceName":"\u9a6c\u6069\u5c9b"},{"name":"VirginIslands,British","value":43,"provinceName":"\u82f1\u5c5e\u7ef4\u5c14\u4eac\u7fa4\u5c9b"},{"name":"Antigua & Barbuda","value":29,"provinceName":"\u5b89\u63d0\u74dc\u548c\u5df4\u5e03\u8fbe"},{"name":"Brunei Darussalam","value":26,"provinceName":"\u6587\u83b1"},{"name":"Holy See","value":26,"provinceName":"\u68b5\u8482\u5188"},{"name":"Mauritius","value":22,"provinceName":"\u6bdb\u91cc\u6c42\u65af"},{"name":"Tinor-Leste","value":21,"provinceName":"\u4e1c\u5e1d\u6c76"},{"name":"Falkland Islands","value":15,"provinceName":"\u798f\u514b\u5170\u7fa4\u5c9b"},{"name":"Guernsey","value":12,"provinceName":"\u6839\u897f\u5c9b"},{"name":"Dominica","value":12,"provinceName":"\u591a\u7c73\u5c3c\u514b"},{"name":"New Caledonia","value":10,"provinceName":"\u65b0\u5580\u91cc\u591a\u5c3c\u4e9a"},{"name":"Saint Kitts and Nevis","value":5,"provinceName":"\u5723\u5176\u8328\u548c\u5c3c\u7ef4\u65af"},{"name":"Greenland","value":5,"provinceName":"\u683c\u9675\u5170"},{"name":"The Republic of Fiji","value":4,"provinceName":"\u6590\u6d4e"},{"name":"Saint Pierre and Miquelon","value":4,"provinceName":"\u5723\u76ae\u57c3\u5c14\u548c\u5bc6\u514b\u9686\u7fa4\u5c9b"},{"name":"Anguilla","value":3,"provinceName":"\u5b89\u572d\u62c9"},{"name":"Laos","value":1,"provinceName":"\u8001\u631d"},{"name":"Montserrat","value":0,"provinceName":"\u8499\u7279\u585e\u62c9\u7279"}]'),
            },
        ],
        animation: false,
    };
    worldChart.setOption(worldoption, true);
    worldChart.resize();

    worldmap = document.getElementById("worldmap");
    cnmap = document.getElementById("cnmap");
    cninfo = document.getElementById("cninfo");
    worldinfo = document.getElementById("worldinfo");
    btncn = document.getElementById('btn-cn');
    btnworld = document.getElementById('btn-world');



        cnmap.style.display = 'none';
    worldmap.style.display = 'block';
    cninfo.style.display = 'none';
    worldinfo.style.display = 'flex';
    btncn.className = 'button';
    btnworld.className = 'button btn-active';
    


    function showcn(e) {

        cnmap.style.display = 'block';
        worldmap.style.display = 'none';
        cninfo.style.display = 'flex';
        worldinfo.style.display = 'none';
        btncn.className = 'button btn-active';
        btnworld.className = 'button';
    }

    function showworld(e) {
        worldmap.style.display = 'block';
        cnmap.style.display = 'none';
        cninfo.style.display = 'none';
        worldinfo.style.display = 'flex';
        btncn.className = 'button';
        btnworld.className = 'button btn-active';
    }
</script>
</body>
</html>
