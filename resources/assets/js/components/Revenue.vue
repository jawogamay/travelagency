<template>
  <div id="app">
    <div class="container">
      <div class="Chart__list">
        <div class="Chart">
          <h2>Revenue</h2>
        
          <bar-example></bar-example>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BarExample from './../line.js'
export default {
  name: 'app',
  components: {
    BarExample
  },

}
</script>

<style scoped>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.container {
  max-width: 1200px;
  margin:  0 auto;
}
</style>