import {Line} from 'vue-chartjs'

export default {
  extends: Line,
  mounted () {
    this.renderChart({
      labels: ['Travel 1', 'Travel 2', 'Travel 3', 'Travel 4', 'Travel 5', 'Travel 6', 'Travel 7'],
      datasets: [
        {
          label: '2018',
          backgroundColor: '#FC2525',
          data: [500000,1000000, 350000, 400000, 250000, 2000000, 3400000]
        },
        {
            label: '2019',
            backgroundColor: '#0ff23e',
            data: [600000,100000, 450000, 1000000, 350000, 2100000, 3200000]
        }
     
        
      ],
      
    }, {responsive: true, maintainAspectRatio: false})

  },
  
}