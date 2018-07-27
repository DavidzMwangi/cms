function loadYearlyData(event) {
    event.preventDefault();
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
    event.preventDefault();
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
                data1.push((parseFloat(obj.morning) + parseFloat(obj.evening))/ 2.0);
                var date = new Date(obj.date)
                data2.push(date.getDate());
            });
            console.log(data1);
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
            drawChart(realDatax, realDatay,'Milking Production in Litres(L)','Date');
        }
    };
    xmlhttp.open("GET", "getmonthlydata.php?q=" + 1, true);
    xmlhttp.send();
}
function loadMonthlyAverageData(event,month) {
    event.preventDefault();

    var url = 'monthaverage.php';
    if (month !== undefined) {
        url = url + '?q=' + month
    }
    $('.months').css('display', 'block');
    $('#' + (1+ new Date().getMonth())).addClass('active');
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
function loadTodaysData(event, date) {
    event.preventDefault();
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

    // $.ajax({
    //     url: url,
    //     error:function (xhr, status, error) {
    //        $('.chart').html('<div class="alert alert-danger"> Error fetching data from server </div>')
    //     },
    //     success:function (result) {
    //         if(result){
    //             console.log(result);
    //         }else {
    //             $('.chart').html('<div class="alert alert-success"> No records found for that date </div>')
    //         }
    //     }
    // })
}

function createTable(data) {
    var str = '<table><tr><td>ID</td><td>Name</td><td>Morning</td><td>Evening</td><td>Average</td></tr>';
    for (var i = 0; i < data.length; i++) {
        var elem = data[i];
        str = str + '<tr><td>' + elem.cow_id + '</td>'
            + '<td>' + elem.morning + '</td>'
            + '<td>' + elem.evening + '</td>';
        var average = (parseFloat(elem.morning) + parseFloat(elem.evening)) / 2.0;
        str = str + '<td>' + average + '</td></tr>';
    }
    str = str + "<table>"
    // data.forEach(function (elem, index) {
    //
    // });

    return str;
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