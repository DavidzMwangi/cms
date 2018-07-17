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