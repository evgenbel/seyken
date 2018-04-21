<template>
    <table class="table table-striped table-sm">
        <tr>
            <th v-for="point in currentPoints">{{ point.name }}</th>
        </tr>
        <tr>
            <td v-for="point in currentPoints">{{ point.point|rounded}}</td>
        </tr>
    </table>
</template>

<script>
    export default {
        // props:['point'],
        data: function(){
          return {
              currentPoints: [],
              interval:{}
          }
        },
        mounted() {
            this.loadData();
            this.interval = setInterval(function(){
                this.loadData();
            }.bind(this), 3000);
        },
        computed: {

        },
        methods: {
            loadData: function(){
                axios.get('api/points').then(function(response){
                    this.currentPoints =  response.data;
                }.bind(this), function(response){
                    // error callback
                    console.log(response);
                });
            }
        },
        beforeDestroy: function(){
            clearInterval(this.interval);
        }
    }
</script>
