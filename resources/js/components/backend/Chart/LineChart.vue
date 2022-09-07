<template>
    <div>
        <canvas id="video-views-chart" width="400" height="400"></canvas>
    </div>
</template>

<script setup>
    import { onMounted, defineProps } from 'vue';
    import { Chart, registerables } from 'chart.js';
    Chart.register(...registerables);

    const props = defineProps(['views']);

    onMounted(() => {
        const ctx = document.querySelector('#video-views-chart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['5 روز پیش', '4 روز پیش', '3 روز پیش', '2 روز پیش', 'دیروز', 'امروز'],
                datasets: [{
                    label: '# of Votes',
                    data: [props.views.days5[0].length, props.views.days4[0].length, props.views.days3[0].length, props.views.days2[0].length, props.views.yesterday[0].length, props.views.today[0].length],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    yAxes: [{
                        display: false
                    }]
                }
            }
        });
    })
</script>