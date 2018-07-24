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
            // console.log(xmlhttp.responseText)
            var data1 = ['milking production'];

            var data2 = ['x'];

            data.forEach(function (obj) {
                data1.push((parseFloat(obj.morning) + parseFloat(obj.evening)) / 2.0);
                var date = new Date(obj.date)
                data2.push(date.getDate());
            });
            console.log(data1);
            console.log(data2);
            drawChart(data1, data2);
        }
    };
    xmlhttp.open("GET", "getmonthlydata.php?q=" + month, true);
    xmlhttp.send();
}

function loadTodaysData(event, date) {
    event.preventDefault();
    var url = 'getdailydata.php';
    if (date !== undefined) {
        url = url + '?q=' + date
    }
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            // var chartDiv = document.getElementById('chart');
            console.log(xmlhttp.responseText)
            // console.log(createTable(xmlhttp.responseText))
            // chartDiv.append(createTable(xmlhttp.responseText));

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

function drawChart(col1, col2) {
    var chart = c3.generate({
        bindto: '#chart',
        data: {
            x: 'x',
            columns: [
                // ['data1', 30, 200, 100, 400, 150, 250],
                col2,
                col1
                // ['data2', 50, 20, 10, 40, 15, 25]
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
                    text: 'Milking Production in Litres(L)',
                    position: 'outer-middle'
                }
            },
            x: {
                label: {
                    text: 'Date',
                    position: 'outer-middle'
                }
            }
        }
    });
}