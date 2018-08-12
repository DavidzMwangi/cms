function loadYearlyData(event) {
    // event.preventDefault();
    $('.months').css('display', 'none');
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var data = JSON.parse(xmlhttp.responseText);
            var months =['x'];
            var averageMilk =['Average milk per month'];
            data.forEach(function (obj) {
                months.push(obj.month);
                averageMilk.push(((parseFloat(obj.morning) + parseFloat(obj.evening))/2.0).toFixed(2))
            });
            drawChart(months, averageMilk,'Average Milk per month(L)', 'month');
        }
    };
    xmlhttp.open("GET", "getyeardata.php?");
    xmlhttp.send();
}

function loadMonthlyData(event, month) {
    // event.preventDefault();
    //remove active class from child elements of months class
    $('.months >.active').removeClass("active");

    var xmlhttp = new XMLHttpRequest();

    if (month === "" || month === undefined) {
        month = new Date().getMonth() + 1;
    }
    $('.months').css('display', 'block');
    $('#' + month).addClass('active');
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            // document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            var data = JSON.parse(xmlhttp.responseText);

            var data1 = [];

            var data2 = [];

            data.forEach(function (obj) {
                data1.push(Number(((parseFloat(obj.morning) + parseFloat(obj.evening))/ 2.0).toFixed(2)));
                var date = new Date(obj.date);
                data2.push(date.getDate());
            });
            // console.log(data1);
            // console.log(data2);

            var realDatax = ['x'];
            var realDatay = ['milking production'];
            var key = data2[0];
            var prevDate;
            var sum = 0;
            var count = 0;
            for (var i = 0; i < data1.length; i++) {
                if (data2[i] === key) {
                    // console.log(parseFloat(data1[i]))
                    sum += parseFloat(data1[i]);
                    count++;
                    if (data1.length-1 === i){
                        realDatax.push(key);
                        realDatay.push(sum);
                    }
                }else {
                    var avg = sum / count;
                    realDatax.push(key);
                    realDatay.push(Number(sum.toFixed(2)));
                    key = data2[i];
                    sum = data1[i];
                    count = 1;
                }
            }
            drawChart(realDatay, realDatax,'Milking Production in Litres(L)','Date');
        }
    };
    console.log(month);
    xmlhttp.open("GET", "getmonthlydata.php?q=" + month, true);
    xmlhttp.send();
}
function loadMonthlyAverageData(event,month) {
    //event.preventDefault();
    $('.months >.active').removeClass("active");
    var url = 'monthaverage.php';
    if (month !== undefined) {
        url = url + '?q=' + month
    }
    $('.months').css('display', 'block');
    $('#' + month).addClass('active');
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            var cows =['x'];
            var averageMilk =['Average milk'];
            data.forEach(function (obj) {
                cows.push(obj.cow_id);
                averageMilk.push(((parseFloat(obj.morning) + parseFloat(obj.evening))/2.0).toFixed(2))
            });
            console.log(cows);
            console.log(averageMilk);
            drawChart(cows, averageMilk,'Average Milk ', 'COW ID','category');
        }

    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();

}
function loadTodaysData(date) {
    //2018-07-10 date format
    // event.preventDefault();
    $('.months').css('display', 'none');
    var url = 'getdailydata.php';
    if (date !== undefined) {
        url = url + '?q=' + date
    }
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var data = JSON.parse(xmlhttp.responseText);
            var cows =['x'];
            var averageMilk =['Average milk'];
            data.forEach(function (obj) {
                cows.push(obj.cow_id);
                averageMilk.push(((parseFloat(obj.morning) + parseFloat(obj.evening))/2.0).toFixed(2))
            });
            console.log(cows);
            console.log(averageMilk);
            drawChart(cows, averageMilk,'Average Milk ', 'COW ID','category');
        }

    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();

}


function drawChart(col1, col2, ylabel, xlabel,xType) {
    var chart = c3.generate({
        bindto: '#chart',
        data: {
            x: 'x',
            columns: [
                col2,
                col1
            ],
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.5 // this makes bar width 50% of length between ticks
            }
            // or
            //width: 100 // this makes bar width 100px
        },
        axis: {
            y: {
                label: {
                    text: ylabel,
                    position: 'outer-middle'
                }
            },
            x: {
                label: {
                    text: xlabel,
                    position: 'outer-middle'
                },
                type:'category'
            }
        }
    });
}