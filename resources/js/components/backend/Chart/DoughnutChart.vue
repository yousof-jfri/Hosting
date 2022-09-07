<template>
    <div>
        <canvas id="view-users-chart" width="400" height="400"></canvas>
    </div>
</template>

<script setup>
    import { onMounted, defineProps } from 'vue';
    import { Chart, registerables } from 'chart.js';
    Chart.register(...registerables);

    let props = defineProps(['users']);
    console.log(props.users)

    onMounted(() => {
        const ctx = document.querySelector('#view-users-chart');
        const data = {
            labels: [
                'کاربران عادی سایت',
                'کاربران که عضو سایت نیستند',
                'کاربران ویژه سایت'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [props.users.normal, props.users.none, props.users.vip],
                backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: data
        });
    })
</script>