<template>
<!--     <div class="container">
        <div class="row justify-content-center">
            <not-found></not-found>
        </div>
    </div> -->
     <div>
     <apexchart width="500" type="bar" :options="chartOptions" :series="series"></apexchart>
   </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)
    export default {
        mounted() {
            console.log('Component mounted.')
        },
          data: function() {
      return {
        chartOptions: {
          chart: {
            id: 'vuechart-example'
          },
          xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
          }
        },
        series: [{
          name: 'series-1',
          data: [30, 40, 45, 50, 49, 60, 70, 91]
        }]
      }
    },
    }
</script>
